<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAttendance;
use App\Models\CourseLecturer;
use App\Models\SessionCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $courses = Course::select(
            'courses.id',
            'courses.code',
            'courses.title',
            DB::raw("COUNT(course_attendances.id) AS classs_taken")
        )
            ->leftJoin('session_courses', 'session_courses.course_id', '=', 'courses.id')
            ->leftJoin('course_attendances', 'course_attendances.session_course_id', '=', 'session_courses.id')
            ->groupBy(
                'courses.id',
                'courses.code',
                'courses.title',
            )
            ->get();

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
            'course_lecturers.created_at',
            'session_courses.id AS session_course_id'
        )
            ->join('session_courses', 'session_courses.id', '=', 'course_lecturers.session_course_id')
            ->join('courses', 'courses.id', '=', 'session_courses.course_id')
            ->join('users', 'users.id', '=', 'course_lecturers.user_id')
            ->where('session_courses.session', Session::get('academic_session'))
            ->where('session_courses.course_id', $id)
            ->get();

        $attendances = CourseAttendance::select(
            'users.title',
            'users.sname',
            'users.fname',
            'users.mname',
            'course_attendances.id',
            'course_attendances.lecturer_id',
            'course_attendances.created_at'
        )
            ->join('session_courses', 'session_courses.id', '=', 'course_attendances.session_course_id')
            ->join('users', 'users.id', '=', 'course_attendances.lecturer_id')
            ->where('session_courses.session', Session::get('academic_session'))
            ->where('session_courses.course_id', $id)
            ->get();

        $this_lecturer = $courseLecturers->where('id', Auth::user()->id)->first();
        if ($this_lecturer) {
            // used to query when marking attendance
            Session::put('session_course_id', $this_lecturer->session_course_id);
            Session::put('this_lecturer', $this_lecturer->id);
        } else {
            // needed to prevent unauthoriced attendance    
            Session::put('session_course_id', null);
            Session::put('this_lecturer', null);
        }

        $clases_taken = CourseAttendance::select(
            DB::raw("COUNT(course_attendances.id) AS num")
        )
            ->join('session_courses', 'session_courses.id', '=', 'course_attendances.session_course_id')
            ->join('courses', 'courses.id', '=', 'session_courses.course_id')
            ->where('session_courses.session', Session::get('academic_session'))
            ->where('courses.code', $course->code)
            ->first()
            ->num;

        return view('course.details')->with(([
            'course' => $course,
            'clases_taken' => $clases_taken,
            'attendances' => $attendances,
            'courseLecturers' => $courseLecturers,
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
