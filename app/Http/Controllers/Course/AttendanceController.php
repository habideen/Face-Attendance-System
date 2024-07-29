<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\AWSRekognition\AttendanceController as AWSRekognitionAttendanceController;
use App\Http\Controllers\Controller;
use App\Models\SessionCourse;
use App\Models\User;
use App\Rules\Base64Image;
use App\Services\RekognitionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('course.attendance');
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
        // return response()->json([
        //     'status' => 'failed',
        //     // 'message' => $enroll->status
        // ]);
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


    public function takeAttendance(Request $request)
    {
        
    }
}
