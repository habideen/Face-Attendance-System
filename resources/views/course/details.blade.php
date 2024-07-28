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
                                <li class="breadcrumb-item"><a href="/{{ Session::get('user_path') }}/dashboard">Dashboard</a>
                                </li>
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
                                        <td>{{ $course->code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Course Title:</td>
                                        <td>{{ $course->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Current Session:</td>
                                        <td>{{ Session::get('academic_session') }}</td>
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
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Created At:</td>
                                        <td>{{ date('d M, Y h:i a', strtotime($course->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Updted At:</td>
                                        <td>{{ date('d M, Y h:i a', strtotime($course->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">
                                <div class="d-flex">
                                    <div>Lecturer</div>
                                    @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
                                        <div class="ms-auto">
                                            <button class="btn btn-primary me-4 btn-sm mb-3" data-bs-toggle="modal"
                                                data-bs-target="#addLecturerModal">Add Lecturer</button>
                                        </div>
                                    @endif
                                </div>

                            </h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Taken By</th>
                                        <th>Created At</th>
                                        @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="/{{ Session::get('user_path') }}/staff/details/98aa7373-4167-4d69-bf4e-05383774968e"
                                                target="_blank">Prof AKINRINDE Olakilekun Ajanlekoko</a></td>
                                        <td>25 May, 2024 11:51 PM</td>
                                        @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
                                            <td><button class="btn btn-danger me-4 btn-sm mb-3" data-bs-toggle="modal"
                                                    data-bs-target="#removeLecturerModal">Remove Lecturer</button></td>
                                        @endif
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
                            <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
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
                                        <td><a href="/{{ Session::get('user_path') }}/staff/details/98aa7373-4167-4d69-bf4e-05383774968e"
                                                target="_blank">Prof AKINRINDE Olakilekun Ajanlekoko</a></td>
                                        <td><a href="/{{ Session::get('user_path') }}/courses/attendance/98aa7373-4167-4d69-bf4e-05383774968e"
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
                            @if (Session::get('user_path') == 'admin' || Session::get('user_path') == 'super-admin')
                                <button class="btn btn-danger me-4">Delete Course</button>
                                <a href="/{{ Session::get('user_path') }}/courses/{{ $course->id }}/edit"
                                    class="btn btn-primary me-4">Edit Course</a>
                            @endif
                            <a href="/{{ Session::get('user_path') }}/courses/attendance/summary/CSC501"
                                class="btn btn-success me-4">View
                                Attendance Summary</a>
                            @if (Session::get('user_path') == 'lecturer')
                                <button class="btn btn-danger me-4" data-bs-toggle="modal"
                                    data-bs-target="#takeAttendanceModal">Take Attendance</button>
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
        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="addLecturerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="addLecturerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLecturerModalLabel">Add Lecturer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" class="mt-5 mb-3">
                            @csrf

                            <input type="hidden" name="user_id" id="user_id">
                            <p class="h4">This lecturer will be added to this course.</p>
                            <x-form.select name="current_password" label="Lecturer" parentClass="mb-3" optionsType="array"
                                :options="[
                                    'Mr Adenipekun Fatai',
                                    'Mrs Oak Florence',
                                    'Prof Jeremy Brown',
                                    'Prof Ivanov Gurevich',
                                ]" />

                            <div class="row mb-4">
                                <x-form.input name="password" label="Password" type="password" required='true'
                                    parentClass="mb-3 mt-4 col-12" placeholder="*****"
                                    bottomInfo="This helps us reduce attack" />
                            </div>

                            <div class="text-center mt-5">
                                <x-form.button defaultText="Add Lecturer" class="btn-lg btn-danger" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="removeLecturerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="removeLecturerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeLecturerModalLabel">Remove Lecturer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" class="mt-5 mb-3">
                            @csrf

                            <input type="hidden" name="user_id" id="user_id">
                            <p class="h4 text-center">Remove this lecturer from this course?</p>
                            <p id="user_fullname" class="text-center">Prof AKINRINDE Olakilekun Ajanlekoko</p>

                            <div class="row mb-4">
                                <x-form.input name="password" label="Password" type="password" required='true'
                                    parentClass="mb-3 mt-4 col-12" placeholder="*****"
                                    bottomInfo="This helps us reduce attack" />
                            </div>

                            <div class="text-center mt-5">
                                <x-form.button defaultText="Detach" class="btn-lg btn-danger" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (Session::get('user_path') == 'lecturer')
        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="takeAttendanceModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="takeAttendanceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="takeAttendanceModalLabel">Mark Attendance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row fw-bold mb-4 bg-light p-2 pt-3 rounded">
                            <div class="col-md-4 mb-2">CSC501</div>
                            <div class="col-md-4 mb-2">Introduction to Networking</div>
                            <div class="col-md-4 mb-2">Total classes: 21</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                                <div class="border text-center bg-light mb-2">
                                    <img src="/assets/images/users/avatar.jpg" alt="enrol face" class="img-fluid">
                                </div>
                                <x-form.button defaultText="<i class='mdi mdi-camera-enhance me-2'></i> Scan Face"
                                    class="btn-lg btn-light" />
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                                <div class="border text-center bg-light mb-2">
                                    <img src="/assets/images/users/avatar.jpg" alt="enrol face" class="img-fluid">
                                </div>
                                <x-form.button defaultText="<i class='mdi mdi-calendar-check me-2'></i> Mark Attendance"
                                    class="btn-lg btn-primary" />
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-7 mt-5 mt-md-0">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>AJANLEKOKO Ojetunji Fiditi</td>
                                        </tr>
                                        <tr>
                                            <td>Matric No.:</td>
                                            <td>CSS/1954/###</td>
                                        </tr>
                                        <tr>
                                            <td>Department:</td>
                                            <td>Computer Science</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>Student Disabled</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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
