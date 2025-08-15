@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Social Media" />
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

                        <!-- Social Form -->
                        <form action="{{ route('doctor.socialmedia.update',Auth::guard('web')->user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="form-group">
                                        <label>{{ __('Facebook URL') }}</label>
                                        <input type="text" name="facebook" value="{{ old('facebook',$social_media?->facebook ??'') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="form-group">
                                        <label>{{ __('Twitter URL') }}</label>
                                        <input type="text" name="twitter" value="{{ old('twitter',$social_media?->twitter ??'') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="form-group">
                                        <label>{{ __('Instagram URL') }}</label>
                                        <input type="text" name="instagram" value="{{ old('instagram',$social_media?->instagram ??'') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="form-group">
                                        <label>{{ __('Pinterest URL') }}</label>
                                        <input type="text" name="pinterest" value="{{ old('pinterest',$social_media?->pinterest ??'') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="form-group">
                                        <label>{{ __('Linkedin URL') }}</label>
                                        <input type="text" name="linkedin" value="{{ old('linkedin',$social_media?->linkedin ??'') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-8">
                                    <div class="form-group">
                                        <label>{{ __('Youtube URL') }}</label>
                                        <input type="text" name="youtube" value="{{ old('youtube',$social_media?->youtube ??'') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>
                        <!-- /Social Form -->

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</div>
<!-- /Page Content -->
@endsection
