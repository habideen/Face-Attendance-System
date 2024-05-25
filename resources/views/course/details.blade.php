@extends('layouts.panel')

@section('page_title', 'Course Details')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Course Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Course Details</li>
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
                                        <td>Course Code:</td>
                                        <td>CSC501</td>
                                    </tr>
                                    <tr>
                                        <td>Course Title:</td>
                                        <td>Introduction to Networking</td>
                                    </tr>
                                    <tr>
                                        <td>Session:</td>
                                        <td>2019/2020</td>
                                    </tr>
                                    <tr>
                                        <td>First Attendance:</td>
                                        <td>12 Dec, 2023</td>
                                    </tr>
                                    <tr>
                                        <td>Last Attendance:</td>
                                        <td>24 May, 2024</td>
                                    </tr>
                                    <tr>
                                        <td>Number of Attendance:</td>
                                        <td>15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Attendances</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Taken By</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>25 May, 2024</td>
                                        <td>11:51 PM</td>
                                        <td><a href="/{{ Request::segment(1) }}/staff/details/98aa7373-4167-4d69-bf4e-05383774968e"
                                                target="_blank">Prof AKINRINDE Olakilekun Ajanlekoko</a></td>
                                        <td><a href="/{{ Request::segment(1) }}/courses/attendance/98aa7373-4167-4d69-bf4e-05383774968e"
                                                class="btn btn-light btn-sm">View attendance</a></td>
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
                            <button class="btn btn-danger me-4">Delete Course</button>
                            <button class="btn btn-primary me-4">Edit Course</button>
                            <a href="/{{ Request::segment(1) }}/courses/attendance/summary/CSC501"
                                class="btn btn-success">View
                                Attendance Summary</a>
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
