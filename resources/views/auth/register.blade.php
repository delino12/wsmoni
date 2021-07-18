@extends('layouts.app')

@section('title')
    Registration
@endsection

@section('contents')
    <div style="height: 100px;"></div>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="contactForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" name="name" />
                        <label for="name">Full name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        @error('name')
                            <script type="text/javascript">
                                swal(
                                    "error",
                                    "{{ $message }}",
                                    "error"
                                );
                            </script>
                        @enderror
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" data-sb-validations="required,email" />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        @error('email')
                            <script type="text/javascript">
                                swal(
                                    "error",
                                    "{{ $message }}",
                                    "error"
                                );
                            </script>
                        @enderror
                    </div>
                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" type="password" placeholder="password" data-sb-validations="required" name="password" />
                        <label for="password">Password</label>
                        <div class="invalid-feedback" data-sb-feedback="password:required">Password is required.</div>
                        @error('password')
                            <script type="text/javascript">
                                swal(
                                    "error",
                                    "{{ $message }}",
                                    "error"
                                );
                            </script>
                        @enderror
                    </div>

                    <!-- Password input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="comfirm-password" type="password" placeholder="password" data-sb-validations="required" name="password_confirmation" />
                        <label for="phone">Confirm password</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">Confirm password</div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Signup successful!</div>
                            Click the link below to login
                            <br />
                            <a href="#">Login</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg" id="submitButton" type="submit">Register</button></div>
                </form>
            </div>
             <div class="col-md-4"></div>
        </div>
    </div>

    <!-- App features section-->
    <section id="features"></section>

    <!-- App badge section-->
    <section class="bg-gradient-primary-to-secondary" id="download">
        <div class="container px-5">
            <h2 class="text-center text-white font-alt mb-4">Sign Up now!</h2>
            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                {{-- <a class="me-lg-3 mb-4 mb-lg-0" href="#!"><img class="app-badge" src="assets/img/google-play-badge.svg" alt="..." /></a> --}}
                {{-- <a href="#!"><img class="app-badge" src="assets/img/app-store-badge.svg" alt="..." /></a> --}}
            </div>
        </div>
    </section>
@endsection
