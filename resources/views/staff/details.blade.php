@extends('layouts.panel')

@section('page_title', 'Staff Details')

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
                        <h4 class="mb-sm-0 font-size-18">Staff Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Session::get('user_path') }}/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Staff Details</li>
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
                                        <td>Staff ID:</td>
                                        <td>{{ $user->school_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{ $user->title . ' ' . $user->sname . ' ' . $user->fname . ' ' . $user->mname }}
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
                                        <td>Roles:</td>
                                        @php
                                            $roles = [];
                                            if ($user->is_admin) {
                                                $roles[] = 'Admin';
                                            }
                                            if ($user->is_adviser) {
                                                $roles[] = 'Class Adviser';
                                            }
                                            if ($user->is_lecturer) {
                                                $roles[] = 'Lecturer';
                                            }
                                            $roles = implode(', ', $roles);
                                        @endphp
                                        <td>{{ $roles }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->is_admin || Auth::user()->is_adviser)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Courses Taken</h4>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Title</th>
                                            <th>Classes Taken</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->code }}</td>
                                                <td>{{ $attendance->title }}</td>
                                                <td>{{ $attendance->classs_taken }}</td>
                                                <td>
                                                    <a href="/{{ Session::get('user_path') }}/courses/{{ $attendance->course_id }}"
                                                        class="btn btn-light btn-sm">Attendance</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Take Action</h4>
                                @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
                                    <a href="/{{ Session::get('user_path') }}/staff/{{ $user->id }}/edit"
                                        class="btn btn-dark me-4 mb-3">Edit Details</a>
                                    @if (Auth::user()->id != $user->id)
                                        <button class="btn btn-danger me-4 mb-3" data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal">Delete User</button>
                                    @endif
                                    <button class="btn btn-primary me-4 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#userRoleModal">Update Role</button>
                                    <a href="/{{ Session::get('user_path') }}/staff/class_adviser/{{ $user->id }}"
                                        class="btn btn-info mb-3 me-4">Class Adviser</a>
                                @endif
                                <a href="/{{ Session::get('user_path') }}/courses/attendance/summary/CSC501"
                                    class="btn btn-success mb-3">View
                                    Attendance Summary</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- row -->
            <!-- card -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @if (Auth::user()->is_admin)
        @include('components.modal.user_role')
        @include('components.modal.delete_user')
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
@endsection
