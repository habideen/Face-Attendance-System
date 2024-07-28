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
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
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
                                    <tr>
                                        <td>CSC 501</td>
                                        <td>Computer Appreciation</td>
                                        <td>17</td>
                                        <td>
                                            @if (Request::segment(1) == 'admin' || Request::segment(1) == 'super-admin')
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#disableModal">Disable</button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCourseModal">Delete</button>
                                            @endif
                                            <a href="/{{ Request::segment(1) }}/courses/details/98aa7373-4167-4d69-bf4e-05383774968e?data_table_search=Prof AKINRINDE Olakilekun Ajanlekoko"
                                                class="btn btn-primary btn-sm">Attendance</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (Request::segment(1) == 'admin' || Request::segment(1) == 'super-admin')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Take Action</h4>
                                <a href="/{{ Request::segment(1) }}/staff/{{ $user->id }}/edit"
                                    class="btn btn-dark me-4 mb-3">Edit Details</a>
                                <button class="btn btn-danger me-4 mb-3" data-bs-toggle="modal"
                                    data-bs-target="#deleteUserModal">Delete User</button>
                                <button class="btn btn-primary me-4 mb-3" data-bs-toggle="modal"
                                    data-bs-target="#userRoleModal">Update Role</button>
                                <a href="/{{ Request::segment(1) }}/courses/attendance/summary/CSC501"
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

    @if (Request::segment(1) == 'admin' || Request::segment(1) == 'super-admin')
        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="disableModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="disableModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disableModalLabel">Disable Staff Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" class="mt-5 mb-3">
                            @csrf

                            <input type="hidden" name="course_id" id="course_id">
                            <p class="h4 f-12 text-center">Are you sure you want to disable <span id="course">Computer
                                    Science</span> for this lecture?</p>

                            <div class="text-center mt-5">
                                <x-form.button defaultText="Disable" class="btn-lg btn-danger" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="deleteCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCourseModalLabel">Delete Staff Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" class="mt-5 mb-3">
                            @csrf

                            <input type="hidden" name="course_id" id="course_id">
                            <p class="h4 f-12 text-center">Are you sure you want to delete <span id="course">Computer
                                    Science</span> for this lecture?</p>

                            <div class="text-center mt-5">
                                <x-form.button defaultText="Delete" class="btn-lg btn-danger" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('components.modal.user_role')
    @include('components.modal.delete_user')
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
