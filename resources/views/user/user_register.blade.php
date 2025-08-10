@extends('layout')
@section('content')
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Register Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{ asset('frontend/assets/img/login-banner.png') }}" class="img-fluid"
                                alt="Doccure Register">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Patient Register <a href="{{ route('doctor.register') }}">Are you a Doctor?</a></h3>
                            </div>

                            <!-- Register Form -->
                            <form action="{{ route('user.register.post') }}" method="POST">
                                @csrf
                                <div class="form-group form-focus">
                                    <input type="text" name="name" class="form-control floating">
                                    <label class="focus-label">Name</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="email" name="email" class="form-control floating">
                                    <label class="focus-label">Email</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" name="phone" class="form-control floating">
                                    <label class="focus-label">Mobile Number</label>
                                </div>
                                 <div class="form-group form-focus">
                                    <input type="date" name="birthday" class="form-control floating">
                                    <label class="focus-label">Date of Birth</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="password" name="password" class="form-control floating">
                                    <label class="focus-label">Create Password</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="password" name="password_confirmation" class="form-control floating">
                                    <label class="focus-label">Confirm Password</label>
                                </div>
                                <div class="form-group form-focus">
                                    <select class="form-control select select2-hidden-accessible" name="blood_group"
                                        tabindex="-1" aria-hidden="true">
                                        <option value="">Select Blood Group</option>
                                        <option value="a-">A-</option>
                                        <option value="a+">A+</option>
                                        <option value="b-">B-</option>
                                        <option value="b+">B+</option>
                                        <option value="ab-">AB-</option>
                                        <option value="ab+">AB+</option>
                                        <option value="o-">O-</option>
                                        <option value="o+">O+</option>
                                    </select>
                                    <label class="focus-label">Blood Group</label>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                            value="male" checked="">
                                        <label class="form-check-label" for="gender_male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                            value="female">
                                        <label class="form-check-label" for="gender_female">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                            value="other">
                                        <label class="form-check-label" for="gender_female">
                                            Other
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group form-focus">
                                    <input type="text" name="address" class="form-control floating">
                                    <label class="focus-label">Address</label>
                                </div>
                                <div class="text-right">
                                    <a class="forgot-link" href="{{ route('user.login') }}">Already have an account?</a>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">or</span>
                                </div>
                                <div class="row form-row social-login">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-facebook btn-block"><i
                                                class="fab fa-facebook-f mr-1"></i> Login</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i>
                                            Login</a>
                                    </div>
                                </div>
                            </form>
                            <!-- /Register Form -->

                        </div>
                    </div>
                </div>
                <!-- /Register Content -->

            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->
@endsection
