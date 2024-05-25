@extends('layouts.panel')

@section('page_title', 'Load Staff')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Load Staff</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Load Staff</li>
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

                            <div class="d-flex mb-5">
                                <div class="ms-auto">
                                    <a href="/file_structure/upload_course">Download Sample File</a>
                                </div>
                            </div>

                            <form method="get">
                                @csrf

                                <div class="row mb-4">
                                    <x-form.input name="course_file" label="Select Excel File" type="file"
                                        accept=".xls, .xlsx, .csv" required='true' parentClass="mb-3 col-12"
                                        bottomInfo="Files: xls, xlsx and csv" placeholder="excel file" />
                                </div>

                                <div class="row mb-4">
                                    <div class="h4 col-12 mb-3">Select Roles</div>
                                    <x-form.switch name="isAdmin" label="Admin" parentClass="mb-3 col-sm-4" />
                                    <x-form.switch name="isStaffAdviser" label="Staff Adviser"
                                        parentClass="mb-3 col-sm-4" />
                                    <x-form.switch name="isLecturer" label="Lecturer" parentClass="mb-3 col-sm-4" />
                                </div>

                                <x-form.button defaultText="Upload Staff" class="mt-4" />

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
