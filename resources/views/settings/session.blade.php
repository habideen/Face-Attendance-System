@extends('layouts.panel')

@section('page_title', 'Set Session')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Set Session</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Set Session</li>
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

                            <div class="mb-4">
                                <b>Current Session:</b> 2019/2020
                            </div>

                            <form method="get">
                                @csrf

                                <div class="row mb-4">
                                    <x-form.select name="session" label="Set Session" parentClass="mb-3 col-sm-6 col-md-3"
                                        required="true" optionsType="array" :options="['2019/2020', '2020/2021']" />

                                </div>

                                <x-form.button defaultText="Update Session" />

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
