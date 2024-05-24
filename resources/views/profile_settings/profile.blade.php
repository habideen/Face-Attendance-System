@extends('layouts.panel')

@section('page_title', 'Update Profile')


@section('content')
  <div class="page-content">
    <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update Profile</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="/{{ Request::segment(1) }}/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Update Profile</li>
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

              <form method="post">
                @csrf

                <div class="h4 mb-5">Admin and top level stakeholders can see your profile details.</div>

                <div class="row mb-4">
                  <x-form.select name="current_password" label="Title" required parentClass="mb-3 col-sm-6 col-md-3"
                    optionsType="array" :options="['Mr', 'King']" />
                  <x-form.input name="current_password" label="Surname" type="text" required
                    parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Surname" />
                  <x-form.input name="current_password" label="First name" type="text" required
                    parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter First name" />
                  <x-form.input name="current_password" label="Middle name" type="text" required
                    parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Middle name" />

                  <x-form.input name="current_password" label="Disabiities" type="text" parentClass="mb-3 col-12"
                    placeholder="e.g. Deaf, Dumb, etc" />
                </div>

                <div class="row mb-4">
                  <div class="h4 col-12">Origin</div>
                  <div class="text-muted mb-3">Only compound is visible if your account is not hidden from the members
                  </div>
                  <x-form.select name="current_password" label="Compound" required parentClass="mb-3 col-sm-6 col-md-3"
                    optionsType="array" :options="['Aro', 'Olota', 'Atoba']" />
                  <x-form.input name="current_password" label="Origin Address" type="text" required
                    parentClass="mb-3 col-sm-6 col-md-3" placeholder="Enter Address" />
                </div>

                <div class="row mb-4">
                  <div class="h4 col-12">Do you want us to know about your <b>residentail address</b>?</div>
                  <x-form.select name="current_password" label="State" parentClass="mb-3 col-sm-6 col-md-3"
                    optionsType="array" :options="['Abia', 'Adamawa']" />
                  <x-form.select name="current_password" label="LGA" parentClass="mb-3 col-sm-6 col-md-3"
                    optionsType="array" :options="[]" />
                  <x-form.input name="current_password" label="Address" type="text"
                    parentClass="mb-3 col-sm-6 col-md-3" placeholder="Address" />
                </div>

                <div class="mb-4">
                  <div class="h4 col-12">Contact</div>
                  <div class="row mb-4">
                    <x-form.input name="current_password" label="Email" type="text" required
                      parentClass="mb-3 col-sm-6" readonly value="bravytech@gmail.com" />
                  </div>
                  <div class="row mb-4">
                    <x-form.input name="current_password" label="Phone 1" type="text" required
                      parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 08165346948" />
                    <x-form.select name="current_password" label="Show phone 1 to all members" required
                      parentClass="mb-3 col-sm-6 col-md-3" optionsType="array" :options="['No', 'Yes']" />
                  </div>
                  <div class="row mb-4">
                    <x-form.input name="current_password" label="Phone 2" type="text"
                      parentClass="mb-3 col-sm-6 col-md-3" placeholder="e.g 08108059570" />
                    <x-form.select name="current_password" label="Show phone 2 to all members"
                      parentClass="mb-3 col-sm-6 col-md-3" optionsType="array" :options="['No', 'Yes']" />
                  </div>
                </div>

                <div class="mb-4">
                  <div class="h4 col-12">Account visibility</div>
                  <div class="row mb-4">
                    <x-form.select name="current_password" label="Show my account to all members" required
                      parentClass="mb-3 col-sm-6 col-md-6 col-lg-5" optionsType="array" :options="['No', 'Yes']" />
                  </div>
                </div>

                <x-form.button defaultText="Update Profile" />

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
