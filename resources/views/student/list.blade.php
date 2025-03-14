@extends('layouts.panel')

@section('page_title', 'View Student')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">View Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Student</li>
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

                            <x-form.button defaultText="Filter Students" data-bs-toggle="modal" class="me-3"
                                data-bs-target="#filterModal" />
                            <x-form.button defaultText="Search By Matric" data-bs-toggle="modal"
                                data-bs-target="#matricModal" />

                            <div class="mt-5">
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Face Enroled</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->school_id }}</td>
                                                <td>{{ $user->title . ' ' . $user->sname . ' ' . $user->fname . ' ' . $user->mname }}
                                                </td>
                                                <td>{{ $user->department }}</td>
                                                <td>{{ $user->face_enrolled ? 'Yes' : 'No' }}</td>
                                                <td><a href="/{{ Request::segment(1) }}/students/{{ $user->id }}"
                                                        class="btn btn-light btn-sm">View</a></td>
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

    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="matricModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="matricModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="matricModalLabel">Filter Student by Matric</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/{{ Session::get('user_path') }}/students" method="get">

                        <x-form.input name="school_id" label="Matriculation Number" type="text" parentClass="mb-3"
                            placeholder="e.g CSC/1950/001" />

                        @csrf

                        <x-form.button defaultText="Find Student" />

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Static Backdrop Modal -->
    <div class="modal fade" id="filterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="get">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="department_id">Department
                            </label>
                            <select name="department_id" id="department_id" class="form-control form-select">
                                <option value=""></option>
                                @php
                                    $departments = departments();
                                @endphp
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                            $startYear = 2015;
                            $currentYear = date('Y');
                            $years = [];

                            // Generate academic years in reverse order
                            for ($year = $currentYear; $year > $startYear; $year--) {
                                $prevYear = $year - 1;
                                $years[] = "$prevYear/$year";
                            }
                        @endphp
                        <div class="form-group mb-3">
                            <label for="session">Session
                            </label>
                            <select name="admission_session" id="admission_session" class="form-control form-select">
                                <option value=""></option>
                                @foreach ($years as $academicYear)
                                    <option value="{{ $academicYear }}">{{ $academicYear }}
                                    </option>
                                @endforeach
                            </select>
                            @error('admission_session')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <x-form.select name="enrolment" label="Enrolment" parentClass="mb-4" optionsType="array"
                            :options="['All', 'Face enrolled', 'Face not enrolled']" />


                        <x-form.button defaultText="Fetch Records" />

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
