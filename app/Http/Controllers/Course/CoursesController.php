<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLecturer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    private function saveRecord(Model $save, Request $request)
    {
        $code = strtoupper($request->code);
        $code = str_replace(' ', '', $code);
        $title = strtoupper($request->title);

        $save->code = $code;
        $save->title = $title;

        return $save->save();
    }

    private function validateData(Request $request)
    {
        $validator = validateCourseRequest($request->all());

        if ($validator->fails()) validateErrorResponseInput($validator, $request);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::select('id', 'code', 'title')->get();

        return view('course.list')->with([
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.course_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        $id = Str::uuid()->toString();

        $save = new Course;
        $save->id = $id;
        $save = $this->saveRecord($save, $request);

        if (!$save) responseSystemError();

        responseSuccess('The course was registered successfully.', '/admin/courses/' . $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        if (!$course) responseError('The course does not exist!');

        $courseLecturers = CourseLecturer::select(
            'users.id',
            'users.school_id',
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'course_lecturers.id AS course_lecturer_id',
            'course_lecturers.created_at'
        )
            ->join('session_courses', 'session_courses.id', '=', 'course_lecturers.session_course_id')
            ->join('courses', 'courses.id', '=', 'session_courses.course_id')
            ->join('users', 'users.id', '=', 'course_lecturers.user_id')
            ->where('session_courses.session', Session::get('academic_session'))
            ->where('session_courses.course_id', $id)
            ->get();

        return view('course.details')->with(([
            'course' => $course,
            'courseLecturers' => $courseLecturers
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);

        if (!$course) responseError('The course does not exist!');

        return view('course.course_form')->with([
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateData($request);

        $save = Course::find($id);
        $save = $this->saveRecord($save, $request);

        if (!$save) responseSystemError();

        responseSuccess('The course was updated successfully.', '/admin/courses/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (!Hash::check($request->password, Auth::user()->password))
            responseError('Your password is invalid!');

        $save = Course::where('id', $id)->delete();

        if (!$save) responseSystemError();

        responseSuccess('Record was deleted successfully.', '/admin/courses');
    }
}
