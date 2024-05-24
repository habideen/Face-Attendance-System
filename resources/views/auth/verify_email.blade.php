@extends('layouts.auth')

@section('page_title', 'Verify Email')


@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> Verify Email</h5>
                                        <p>Confirm the email with us.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="/">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="/assets/images/logo.png" alt=""
                                                class="rounded" height="50">
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <x-alert />

                            <div class="p-2">
                                <form class="form-horizontal" action="/email_verification_sent">

                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Send
                                            verification code</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>What to return to login page? <a href="/login" class="fw-medium text-primary"> Sign In here</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
