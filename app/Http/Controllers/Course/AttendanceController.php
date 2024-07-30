<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\AWSRekognition\AttendanceController as AWSRekognitionAttendanceController;
use App\Http\Controllers\Controller;
use App\Models\CourseAttendance;
use App\Models\IndividualAttendance;
use App\Models\SessionCourse;
use App\Models\User;
use App\Rules\Base64Image;
use App\Services\RekognitionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function index(string $id)
    {
        $attendance = CourseAttendance::select(
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'course_attendances.lecturer_id',
            'course_attendances.created_at'
        )
            ->join('users', 'users.id', '=', 'course_attendances.lecturer_id')
            ->where('course_attendances.id', $id)
            ->first();

        $records = IndividualAttendance::select(
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'users.school_id',
            'individual_attendances.created_at'
        )
            ->join('users', 'users.id', '=', 'individual_attendances.user_id')
            ->where('individual_attendances.course_attendance_id', $id)
            ->get();

        return view('course.attendance')->with([
            'attendance' => $attendance,
            'records' => $records
        ]);
    } //index


    public function summary()
    {
        return view('course.attendance_summary');
    } //summary


    public function enroll(Request $request, string $student_id)
    {
        $student = User::select('id', 'face_enrolled')
            ->where('id', $student_id)
            ->whereNotNull('is_student')->first();

        if (!$student) responseError('The student does not exist!');

        if ($student->face_enrolled) {
            if (!Hash::check($request->password, Auth::user()->password))
                responseError('Your password is invalid!');
        }

        $rekognition = new RekognitionService;
        $object = new AWSRekognitionAttendanceController($rekognition);

        if ($student->face_enrolled) {
            $request->merge(['face_id' => $student->face_enrolled]);
            $delete = $object->deleteFace($request)->getData();

            if (isset($delete->error)) responseError('We were unable to delete your previous face!');
        }

        $enroll = $object->enroll($request)->getData();

        if (!isset($enroll->faceId)) responseError('We could not process this page');
        $update = User::where('id', $student_id)->update([
            'face_enrolled' => $enroll->faceId
        ]);

        if (!$update) responseError('We could not register this face. Please try again!');

        responseSuccess('Face enrolment successful.');
    }


    public function checkFace(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['required', new Base64Image]
        ]);

        if ($validator->fails()) responseError('The image format is invalid');

        $rekognition = new RekognitionService;
        $object = new AWSRekognitionAttendanceController($rekognition);
        $enroll = $object->checkAttendance($request)->getData();

        if ($enroll->status == 'Match not found') {
            return response()->json([
                'status' => 'failed',
                'message' => $enroll->status,
                'similarity' => '',
                'faceId' => '',
                'student_id' => '',
                'student_name' => '',
                'school_id' => '',
                'department' => '',
                'is_disabled' => '',
            ]);
        }

        $user = User::select(
            'users.id',
            'users.school_id',
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'users.is_disabled',
            'departments.department'
        )
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->whereNotNull('is_student')
            ->where('face_enrolled', $enroll->data[0]->Face->FaceId)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Face still exist but the student record no longer exist!',
                'similarity' => '',
                'faceId' => '',
                'student_id' => '',
                'student_name' => '',
                'school_id' => '',
                'department' => '',
                'is_disabled' => '',
            ]);
        }

        return response()->json([
            'status' => 'successful',
            'message' => $enroll->status,
            'similarity' => $enroll->data[0]->Similarity,
            'faceId' => $enroll->data[0]->Face->FaceId,
            'student_id' => $user->id,
            'student_name' => $user->sname . ' ' . $user->fname . ' ' . $user->mname,
            'school_id' => $user->school_id,
            'department' => $user->department,
            'is_disabled' => $user->is_disabled
        ]);
    }


    private function increaseAttendance()
    {
        return CourseAttendance::where('session_course_id', Session::get('session_course_id'))
            ->where('lecturer_id', Session::get('this_lecturer'))
            ->whereDate('created_at', now())
            ->increment('attendance_count', 1);
    }


    private function individualAttendance()
    {
        $record = CourseAttendance::select('id')
            ->where('session_course_id', Session::get('session_course_id'))
            ->where('lecturer_id', Session::get('this_lecturer'))
            ->whereDate('created_at', now())
            ->first();

        if ($record) {
            return $record->id;
        }

        $id = Str::uuid();
        $save = new CourseAttendance;
        $save->id = $id;
        $save->session_course_id =  Session::get('session_course_id');
        $save->lecturer_id =  Session::get('this_lecturer');
        $save->save();

        if (!$save) responseError('System error! We could not establish a valid attendance.');
        return $id;
    }


    public function takeAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => [
                'required', 'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::select('is_disabled')->where('id', $value)->first();
                    if ($user && $user->is_disabled == 1) {
                        $fail('The selected user is disabled.');
                    }
                },
            ]
        ]);

        $message = '';

        if ($validator->fails()) {
            $message = 'Invalid user submitted!';
        } elseif (!Session::get('session_course_id') || !Session::get('this_lecturer')) {
            $message = 'You are not authorized to take this attendance!';
        }

        if ($message) return response()->json([
            'status' => 'failed',
            'message' => $message,
            'similarity' => '',
            'faceId' => '',
            'student_id' => '',
            'student_name' => '',
            'school_id' => '',
            'department' => '',
            'is_disabled' => '',
        ]);

        $attendanceID = $this->individualAttendance();

        // prevent double attendance
        $save = IndividualAttendance::select('id')
            ->where('course_attendance_id', $attendanceID)
            ->where('user_id', $request->student_id)
            ->first();

        if (!$save) {
            $save = new IndividualAttendance;
            $save->id = Str::uuid();
            $save->user_id =  $request->student_id;
            $save->course_attendance_id =  $attendanceID;
            $save->save();
        }

        if (!$save || !$this->increaseAttendance())
            responseError('System error! We could not mark this attendance. Please try again.');

        return response()->json([
            'status' => 'successful',
            'message' => 'Attendance marked successfully.',
            'similarity' => '',
            'faceId' => '',
            'student_id' => '',
            'student_name' => '',
            'school_id' => '',
            'department' => '',
            'is_disabled' => '',
        ]);
    }
}
