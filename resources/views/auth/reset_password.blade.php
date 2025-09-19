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
                                <h3>{{ __('Reset Password') }}</h3>
                            </div>

                            <!-- Forgot Password Form -->
                            <form action="{{ route('user.reset.password.post') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-focus">
                                    <input type="password" name="password" class="form-control floating">
                                    <label class="focus-label">{{ __('New Password') }}</label>
                                </div>
                                <input type="hidden" name="forget_token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">
                                <div class="form-group form-focus">
                                    <input type="password" name="password_confirmation" class="form-control floating">
                                    <label class="focus-label">{{ __('Confirm Password') }}</label>
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
