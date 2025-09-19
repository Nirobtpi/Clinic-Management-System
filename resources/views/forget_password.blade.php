@extends('layout')

@section('content')
<div class="content" style="min-height: 169px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Account Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{ asset('frontend/assets/img/login-banner.png') }}" class="img-fluid" alt="Login Banner">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Forgot Password?</h3>
                                <p class="small text-muted">{{ __('Enter your email to get a password reset link') }}</p>
                            </div>

                            <!-- Forgot Password Form -->
                            <form action="{{ route('user.forget.password.post') }}" method="POST">
                                @csrf
                                <div class="form-group form-focus">
                                    <input type="email" name="email" class="form-control floating">
                                    <label class="focus-label">{{ __('Email') }}</label>
                                </div>
                                <div class="text-right">
                                    <a class="forgot-link" href="{{ route('user.login') }}">{{ __('Remember your password?') }}</a>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{ __('Reset Password') }}</button>
                            </form>
                            <!-- /Forgot Password Form -->

                        </div>
                    </div>
                </div>
                <!-- /Account Content -->

            </div>
        </div>

    </div>

</div>

@endsection
