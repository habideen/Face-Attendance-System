@extends('layouts.panel')

@section('page_title', 'Add Lecturer')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Lecturer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Lecturer</li>
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
                            <div class="mb-3">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Course Code:</td>
                                            <td>{{ $course->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Course Title:</td>
                                            <td>{{ $course->title }}</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>The lecture will be added to :</td>
                                            <td class="text-danger">{{ Session::get('academic_session') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-5">
                                <h5>List of lecturers</h5>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lecturers as $lecturer)
                                            <tr>
                                                <td>{{ $lecturer->school_id }}</td>
                                                <td>{{ $lecturer->title . ' ' . $lecturer->sname . ' ' . $lecturer->fname . ' ' . $lecturer->mname }}
                                                </td>
                                                <td>{{ $lecturer->department }}</td>
                                                <td>
                                                    <form
                                                        action="/{{ Session::get('user_path') }}/courses/add_lecturer/{{ $course->id }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="lecturer" value="{{ $lecturer->id }}">
                                                        <button type="submit" class="btn btn-light btn-sm">Add</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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



@section('css')
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
@endsection


@section('script')
    <!-- Required datatable js -->
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
