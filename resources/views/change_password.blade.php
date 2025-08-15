@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Chnage Password" />
@endsection
@section('content')
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Profile Sidebar -->
            @include('doctor.doctor_sidebar')
            <!-- /Profile Sidebar -->
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">

                                <!-- Change Password Form -->
                                <form action="{{ route('password.update',Auth::user()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>{{ __('Old Password') }}</label>
                                        <input type="password" name="old_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('New Password') }}</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                    </div>
                                </form>
                                <!-- /Change Password Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</div>
<!-- /Page Content -->
@endsection
