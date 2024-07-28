@extends('layouts.panel')

@section('page_title', 'Add Course')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Course</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <x-alert />

                            <form method="post"
                                action="/{{ Session::get('user_path') }}/courses{{ isset($course) ? '/' . $course->id : '' }}">
                                @csrf
                                @isset($course)
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                @endisset

                                <div class="row mb-4">
                                    <x-form.input name="code" label="Course code" type="text" required='true'
                                        parentClass="mb-3 col-sm-4" placeholder="e.g. CSC501"
                                        value="{{ old('code') ?? ($course->code ?? '') }}"
                                        pattern="^[ ]*[a-zA-Z]{3,3}[ ]*[0-9]{3,3}[ ]*$" />
                                    <x-form.input name="title" label="Course title" type="text" required='true'
                                        parentClass="mb-3 col-sm-8" placeholder="e.g. Introduction to Networking"
                                        value="{{ old('title') ?? ($course->title ?? '') }}" />
                                </div>

                                <x-form.button defaultText="{{ isset($course) ? 'Update' : 'Save' }} Course" />

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <!-- card -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
