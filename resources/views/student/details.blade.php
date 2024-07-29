@extends('layouts.panel')

@section('page_title', 'Student Details')

@php
    $accountType = 'admin';
@endphp


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Student Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Session::get('user_path') }}/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Student Details</li>
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

                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>Student ID:</td>
                                        <td>{{ $user->school_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{ $user->sname . ' ' . $user->fname . ' ' . $user->mname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone 1:</td>
                                        <td>{{ $user->phone_1 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone 2:</td>
                                        <td>{{ $user->phone_2 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Department:</td>
                                        <td>{{ $user->department }}</td>
                                    </tr>
                                    <tr>
                                        <td>Face registered:</td>
                                        <td>{!! $user->face_enrolled ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>' !!} <span class="text-muted">(It must be
                                                registered for attendance)</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Courses Taken</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Classes Attended</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CSC/2019/###</td>
                                        <td>Computer Appreciation</td>
                                        <td>17</td>
                                        <td>
                                            <a href="javascript: void(0)"
                                                hredf="/{{ Session::get('user_path') }}/courses/details/98aa7373-4167-4d69-bf4e-05383774968e"
                                                class="btn btn-light btn-sm">Attendance</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Take Action</h4>
                            @if (Auth::user()->is_admin)
                                <button class="btn btn-danger me-4 mb-3" data-bs-toggle="modal"
                                    data-bs-target="#deleteUserModal">Delete Student</button>
                            @endif
                            @if (Auth::user()->is_admin || Auth::user()->is_adviser)
                                <button class="btn btn-primary me-4 mb-3" data-bs-toggle="modal"
                                    data-bs-target="#disableUserModal">{{ !$user->is_disabled ? 'Disable' : 'Enable' }}
                                    Student</button>
                            @endif
                            @if (Auth::user()->is_adviser)
                                <button class="btn btn-success me-4 mb-3" data-bs-toggle="modal"
                                    data-bs-target="#enrolFaceModal">{!! !$user->face_enrolled ? 'Enrol Face' : 'Face already enrolled' !!}</button>
                            @endif
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

    <!-- Static Backdrop Modal -->
    @if (Auth::user()->is_admin || Auth::user()->is_adviser)
        @include('components.modal.disable_user')
    @endif

    @if (Auth::user()->is_admin)
        @include('components.modal.delete_user')
    @endif

    @if (Auth::user()->is_adviser)
        @include('components.modal.enrol_face')
    @endif
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
    @if (Auth::user()->is_adviser)
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js"></script>
        <script src="/test/script.js"></script>
        <script>
            $('#enrol_form').on('submit', function(event) {
                if ($('#image_value').val() == '') {
                    alert('Please capture a face!');
                    event.preventDefault();
                }
            });
        </script>
    @endif
@endsection
