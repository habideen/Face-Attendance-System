@extends('layouts.panel')

@section('page_title', 'My Profile')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">My Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
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

                            <form method="post" action="/{{ Session::get('user_path') }}/profile">
                                @csrf
                                @method('PATCH')

                                <div class="row mb-4">
                                    <x-form.select name="title" label="Title" required="true" disabled
                                        parentClass="mb-3 col-sm-6 col-md-3" optionsType="array" :options="['Mr', 'Mrs', 'Dr', 'Prof']" />
                                    <x-form.input name="sname" label="Surname" type="text" required='true' disabled
                                        parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Surname"
                                        value="{{ old('sname') ?? (Auth::user()->sname ?? '') }}" />
                                    <x-form.input name="fname" label="First name" type="text" required='true' disabled
                                        parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter First name"
                                        value="{{ old('fname') ?? (Auth::user()->fname ?? '') }}" />
                                    <x-form.input name="mname" label="Middle name" type="text"
                                        parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Middle name" disabled
                                        value="{{ old('mname') ?? (Auth::user()->mname ?? '') }}" />
                                </div>

                                <div class="row mb-4">
                                    <x-form.input name="office_address" label="Office Address" type="text"
                                        required='true' parentClass="mb-3 col-12" placeholder="Enter Address"
                                        value="{{ old('office_address') ?? (Auth::user()->office_address ?? '') }}" />
                                </div>

                                <div class="mb-4">
                                    <div class="h4 col-12">Contact</div>
                                    <div class="row mb-4">
                                        <x-form.input name="email" label="Email" type="email" required='true'
                                            parentClass="mb-3 col-sm-6" placeholder="e.g. abc@xyx.com" disabled
                                            value="{{ old('email') ?? (Auth::user()->email ?? '') }}" />
                                        <x-form.input name="phone_1" label="Phone 1" type="text" required='true'
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 08165346948"
                                            value="{{ old('phone_1') ?? (Auth::user()->phone_1 ?? '') }}" />
                                        <x-form.input name="phone_2" label="Phone 1" type="text"
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 09059798994"
                                            value="{{ old('phone_2') ?? (Auth::user()->phone_2 ?? '') }}" />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="h4 col-12">Registration</div>
                                    <div class="row mb-4">
                                        <div class="form-group mb-3 col-sm-12 col-md-6">
                                            <label for="department_id">Department <span class="text-danger">*</span>
                                            </label>
                                            <select name="department_id" id="department_id" class="form-control form-select"
                                                required disabled>
                                                <option value=""></option>
                                                @php
                                                    $departments = departments();
                                                @endphp
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}" @selected(old('department_id') == $department->id || Auth::user()->department_id == $department->id)>
                                                        {{ $department->department }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <x-form.input name="school_id" label="ID No." type="text" required='true'
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g CSC/1950/001" disabled
                                            value="{{ old('school_id') ?? (Auth::user()->school_id ?? '') }}" />
                                        <x-form.input name="admission_session" label="Session Accepted" type="text"
                                            required='true' parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 2022/2023"
                                            pattern="^\d{4}\/\d{4}$" disabled
                                            value="{{ old('admission_session') ?? (Auth::user()->admission_session ?? '') }}" />
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="h4 col-12 mb-3">Select Roles</div>
                                    <x-form.switch name="is_admin" label="Admin" parentClass="mb-3 col-sm-4" disabled
                                        ischecked="{{ old('is_admin') || Auth::user()->is_admin ? 'true' : 'false' }}" />
                                    <x-form.switch name="is_adviser" label="Staff Adviser" parentClass="mb-3 col-sm-4"
                                        disabled
                                        ischecked="{{ old('is_adviser') || Auth::user()->is_adviser ? 'true' : 'false' }}" />
                                    <x-form.switch name="is_lecturer" label="Lecturer" parentClass="mb-3 col-sm-4"
                                        disabled
                                        ischecked="{{ old('is_lecturer') || Auth::user()->is_lecturer ? 'true' : 'false' }}" />
                                </div>

                                <x-form.button defaultText="Update Profile" class="mt-4" />

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

@section('script')
    <script>
        $('#title').val('{{ old('title') ?? Auth::user()->title }}')
    </script>
@endsection
