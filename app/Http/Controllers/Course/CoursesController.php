<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        $validator = validateCourseRequest($request->all());

        if ($validator->fails()) validateErrorResponseInput($validator, $request);

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

        return view('course.details')->with(([
            'course' => $course
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
        $validator = validateCourseRequest($request->all());

        if ($validator->fails()) validateErrorResponseInput($validator, $request);

        $save = Course::find($id);
        $save = $this->saveRecord($save, $request);

        if (!$save) responseSystemError();

        responseSuccess('The course was updated successfully.', '/admin/courses/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
