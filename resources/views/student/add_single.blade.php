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

                            <form method="get">
                                @csrf

                                <div class="row mb-4">
                                    <x-form.select name="current_password" label="Title" required="true"
                                        parentClass="mb-3 col-sm-6 col-md-3" optionsType="array" :options="['Mr', 'Mrs', 'Dr', 'Prof']" />
                                    <x-form.input name="current_password" label="Surname" type="text" required='true'
                                        parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Surname" />
                                    <x-form.input name="current_password" label="First name" type="text" required='true'
                                        parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter First name" />
                                    <x-form.input name="current_password" label="Middle name" type="text"
                                        parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Middle name" />
                                </div>

                                <div class="mb-4">
                                    <div class="h4 col-12">Contact</div>
                                    <div class="row mb-4">
                                        <x-form.input name="email" label="Email" type="text" required='true'
                                            parentClass="mb-3 col-sm-6" placeholder="e.g. abc@xyx.com" />
                                        <x-form.input name="phone_1" label="Phone 1" type="text" required='true'
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 08165346948" />
                                        <x-form.input name="phone_2" label="Phone 1" type="text"
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 09059798994" />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="h4 col-12">Registration</div>
                                    <div class="row mb-4">
                                        <x-form.select name="department" label="Department" required='true'
                                            parentClass="mb-3 col-sm-6 col-md-6 col-lg-5" optionsType="array"
                                            :options="['None', 'Computer Science', 'Electrical/Electronics']" />
                                        <x-form.input name="id" label="ID No." type="text" required='true'
                                            parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g CSC/1950/001" />
                                    </div>
                                </div>

                                <x-form.button defaultText="Add User" class="mt-4" />

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
