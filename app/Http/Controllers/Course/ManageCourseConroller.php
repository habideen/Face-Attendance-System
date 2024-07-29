<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLecturer;
use App\Models\SessionCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ManageCourseConroller extends Controller
{
    private function createSessionCourse($course_id)
    {
        $sessionCourse = SessionCourse::select('id')
            ->where('course_id', $course_id)
            ->where('session', Session::get('academic_session'))->first();

        if (!$sessionCourse) {
            $id = Str::uuid();

            $save = new SessionCourse;
            $save->id = $id;
            $save->course_id = $course_id;
            $save->session = Session::get('academic_session');
            $save->save();

            if (!$save) responseError('System Error! We could not create a course for this session!');

            return $id;
        }

        return $sessionCourse->id;
    }

    public function addLecturerView(string $id)
    {
        $course = Course::select('id', 'code', 'title')->where('id', $id)->first();

        if (!$course) responseError('The course does not exist!');

        $courseLecturers = CourseLecturer::select(
            'course_lecturers.user_id'
        )
            ->join('session_courses', 'session_courses.id', '=', 'course_lecturers.session_course_id')
            ->join('courses', 'courses.id', '=', 'session_courses.course_id')
            ->where('session_courses.session', Session::get('academic_session'))
            ->where('courses.id', $id)
            ->get()->pluck('user_id');


        $lecturers = User::select(
            'users.id',
            'users.school_id',
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'departments.department'
        )
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->whereNotNull('is_lecturer')
            ->whereNotIn('users.id', $courseLecturers)
            ->get();

        return view('course.add_lecturer')->with([
            'course' => $course,
            'lecturers' => $lecturers
        ]);
    }


    public function addLecturer(Request $request, string $id)
    {
        $course = Course::select('id')->where('id', $id)->first();

        if (!$course) responseError('The course does not exist!');

        $lecturer = User::select('id')
            ->where('id', $request->lecturer)
            ->whereNotNull('is_lecturer')
            ->first();

        if (!$lecturer) responseError('The lecturer does not exist!');

        // a record is created for each course at every session
        $sessionCourseID = $this->createSessionCourse($id);

        $id = Str::uuid();

        $save = new CourseLecturer;
        $save->id = $id;
        $save->user_id = $request->lecturer;
        $save->session_course_id = $sessionCourseID;
        $save->save();

        if (!$save) responseError('System Error! We could not add this lecturer!');

        responseSuccess('Lecturer added to this course successfully.');
    }


    public function removeLecturer(Request $request)
    {
        if (!Hash::check($request->password, Auth::user()->password))
            responseError('Your password is invalid!');

        $delete = CourseLecturer::where('id', $request->user_id)->delete();

        if (!$delete) responseError('System error! We could not delete the lecturer.');

        responseSuccess('The lecturer was deleted successfully');
    }
}
