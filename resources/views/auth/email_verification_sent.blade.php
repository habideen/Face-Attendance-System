@extends('layouts.auth')

@section('page_title', 'Email Verification Sent')


@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5 text-muted">
                        <a href="/" class="d-block auth-logo">
                            <img src="/assets/images/logo.png" alt="logo" height="54"
                                class="auth-logo-dark mx-auto">
                            <img src="/assets/images/logo.png" alt="logo" height="54"
                                class="auth-logo-light mx-auto">
                        </a>
                        <p class="mt-3">We value your security. Please verify your email.</p>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body">
                            <div class="p-2">
                                <div class="text-center">
                                    <div class="p-2 mt-4">
                                        <h4>Verify your email</h4>
                                        <p>We have sent you verification email <span
                                                class="fw-semibold">example@abc.com</span>. Please check
                                            it.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Did't receive an email ? <a href="#" class="fw-medium text-primary"> Resend </a> </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
