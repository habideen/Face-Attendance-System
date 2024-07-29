<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\AWSRekognition\AttendanceController as AWSRekognitionAttendanceController;
use App\Http\Controllers\Controller;
use App\Models\SessionCourse;
use App\Models\User;
use App\Services\RekognitionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
