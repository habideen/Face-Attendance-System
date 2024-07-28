@extends('layouts.panel')

@section('page_title', 'Add Single Student')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Single Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Single Student</li>
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

                            <form method="post" action="/admin/students{{ isset($user) ? '/' . $user->id : '' }}">
                                @csrf
                                @isset($user)
                                    @method('PATCH')
                                @endisset

                                <div class="row mb-4">
                                    <x-form.input name="sname" label="Surname" type="text" required='true'
                                        parentClass="mb-3 col-sm-4" placeholder="Enter Surname"
                                        value="{{ old('sname') ?? ($user->sname ?? '') }}" />
                                    <x-form.input name="fname" label="First name" type="text" required='true'
                                        parentClass="mb-3 col-sm-4" placeholder="Enter First name"
                                        value="{{ old('fname') ?? ($user->fname ?? '') }}" />
                                    <x-form.input name="mname" label="Middle name" type="text"
                                        parentClass="mb-3 col-sm-4" placeholder="Enter Middle name"
                                        value="{{ old('mname') ?? ($user->mname ?? '') }}" />
                                </div>

                                <div class="mb-4">
                                    <div class="h4 col-12">Contact</div>
                                    <div class="row mb-4">
                                        <x-form.input name="email" label="Email" type="email" required='true'
                                            parentClass="mb-3 col-sm-6" placeholder="e.g. abc@xyx.com"
                                            value="{{ old('email') ?? ($user->email ?? '') }}" />
                                        <x-form.input name="phone_1" label="Phone 1" type="text"
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 08165346948"
                                            value="{{ old('phone_1') ?? ($user->phone_1 ?? '') }}" />
                                        <x-form.input name="phone_2" label="Phone 1" type="text"
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 09059798994"
                                            value="{{ old('phone_2') ?? ($user->phone_2 ?? '') }}" />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="h4 col-12">Registration</div>
                                    <div class="row mb-4">
                                        <div class="form-group mb-3 col-sm-12 col-md-6">
                                            <label for="department_id">Department <span class="text-danger">*</span>
                                            </label>
                                            <select name="department_id" id="department_id" class="form-control form-select"
                                                required>
                                                <option value=""></option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->department }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <x-form.input name="school_id" label="ID No." type="text" required='true'
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g CSC/1950/001"
                                            value="{{ old('school_id') ?? ($user->school_id ?? '') }}" />
                                        <x-form.input name="admission_session" label="Session Accepted" type="text"
                                            required='true' parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 2022/2023"
                                            pattern="^\d{4}\/\d{4}$"
                                            value="{{ old('admission_session') ?? ($user->admission_session ?? '') }}" />
                                    </div>
                                </div>

                                <x-form.button defaultText="{{ isset($user) ? 'Edit' : 'Add' }} User" class="mt-4" />

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
