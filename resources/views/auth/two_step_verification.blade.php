@extends('layouts.auth')

@section('page_title', 'Two Steps Verification')


@section('content')
  <div class="account-pages my-5 pt-sm-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center mb-5 text-muted">
            <a href="index.html" class="d-block auth-logo">
              <img src="/assets/images/logo.png" alt="logo" height="54" class="auth-logo-dark mx-auto">
              <img src="/assets/images/logo.png" alt="logo" height="54" class="auth-logo-light mx-auto">
            </a>
            <p class="mt-3">We value your security.</p>
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
                    <p class="mb-5">Please enter the 4 digit code sent to <span
                        class="fw-semibold">example@abc.com</span></p>

                    <form>
                      <div class="row">
                        <div class="col-3">
                          <div class="mb-3">
                            <label for="digit1-input" class="visually-hidden">Dight 1</label>
                            <input type="text" class="form-control form-control-lg text-center"
                              onkeyup="moveToNext(this, 2)" maxLength="1" id="digit1-input">
                          </div>
                        </div>

                        <div class="col-3">
                          <div class="mb-3">
                            <label for="digit2-input" class="visually-hidden">Dight 2</label>
                            <input type="text" class="form-control form-control-lg text-center"
                              onkeyup="moveToNext(this, 3)" maxLength="1" id="digit2-input">
                          </div>
                        </div>

                        <div class="col-3">
                          <div class="mb-3">
                            <label for="digit3-input" class="visually-hidden">Dight 3</label>
                            <input type="text" class="form-control form-control-lg text-center"
                              onkeyup="moveToNext(this, 4)" maxLength="1" id="digit3-input">
                          </div>
                        </div>

                        <div class="col-3">
                          <div class="mb-3">
                            <label for="digit4-input" class="visually-hidden">Dight 4</label>
                            <input type="text" class="form-control form-control-lg text-center"
                              onkeyup="moveToNext(this, 4)" maxLength="1" id="digit4-input">
                          </div>
                        </div>
                      </div>
                    </form>

                    <div class="mt-4">
                      <a href="index.html" class="btn btn-success w-md">Confirm</a>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
          <div class="mt-5 text-center">
            <p>Did't receive a code ? <a href="#" class="fw-medium text-primary"> Resend </a> </p>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
