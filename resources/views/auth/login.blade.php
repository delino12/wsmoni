@extends('layouts.app')

@section('title')
    Login
@endsection

@section('contents')
    <div style="height: 100px;"></div>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form  method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" name="email" />
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

                    <div class="form-floating mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <!---->

                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg" id="submitButton" type="submit">Login</button></div>
                </form>
            </div>
             <div class="col-md-4"></div>
        </div>
    </div>
@endsection
