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
                                        <th>Department</th>
                                        <th>Session</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($advisers as $adviser)
                                        <tr>
                                            <td>{{ $adviser->department }}</td>
                                            <td>{{ $adviser->session }}</td>
                                            <td>{{ date('d M, Y h:i a', strtotime($adviser->created_at)) }}</td>
                                            <td>{{ date('d M, Y h:i a', strtotime($adviser->updated_at)) }}</td>
                                            <td>
                                                @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
                                                    <form
                                                        action="/{{ Session::get('user_path') }}/staff/class_adviser/delete/{{ $adviser->id }}"
                                                        onsubmit="if(!confirm('Delete this record?')) {event.preventDefault()}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-light btn-sm">Delete</button>
                                                    </form>
                                                @endif

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
                                @if ($user->is_adviser)
                                    <button class="btn btn-info me-4 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#classAdviserModal">Use As Class Adviser</button>
                                @else
                                    <button class="btn btn-info me-4 mb-3 disabled">User is not class adviser</button>
                                @endif
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

    @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
        @include('components.modal.class_adviser')
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
