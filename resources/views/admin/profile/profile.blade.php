@extends('admin.layout.master')
@section('title', 'Profile')
@push('css')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#">
                        <img class="rounded-circle" alt="User Image" id="blah"
                            src="{{ Auth::guard('admin')->user()->photo == null ? asset('backend/assets/img/profiles/avatar-01.jpg') : asset(Auth::guard('admin')->user()->photo) }}">
                    </a>
                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0">{{ ucfirst(Auth::guard('admin')->user()->name) }}</h4>
                    <h6 class="text-muted">{{ Auth::guard('admin')->user()->email }}</h6>
                    <div class="user-Location"><i class="fa fa-map-marker"></i>
                        {{ Auth::guard('admin')->user()->address }}, {{ Auth::guard('admin')->user()->country }}</div>
                    <div class="about-text">{{ Auth::guard('admin')->user()->about_me }}</div>
                </div>
                {{-- <div class="col-auto profile-btn">

                    <a href="#" class="btn btn-primary">
                        Edit
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password_tab">{{ __('Password') }}</a>
                </li>
            </ul>
        </div>
        <div class="tab-content profile-tab-cont">

            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">

                <!-- Personal Details -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>{{ __('Personal Details') }}</span>
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                            class="fa fa-edit mr-1"></i>Edit</a>
                                </h5>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                    <p class="col-sm-10">{{ ucfirst(Auth::guard('admin')->user()?->name) }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">{{ __('Date of Birth') }}
                                    </p>
                                    <p class="col-sm-10">
                                        {{ date('d M, Y', strtotime(Auth::guard('admin')->user()?->birthday)) }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">{{ __('Email ID') }}</p>
                                    <p class="col-sm-10">{{ Auth::guard('admin')->user()?->email }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">{{ __('Mobile') }}</p>
                                    <p class="col-sm-10">{{ Auth::guard('admin')->user()?->phone }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0">{{ __('Address') }}</p>
                                    <p class="col-sm-10 mb-0">{{ Auth::guard('admin')->user()?->address }},<br>
                                        {{ Auth::guard('admin')?->user()->city }},<br>
                                        {{ Auth::guard('admin')?->user()->state }},<br>
                                        {{ Auth::guard('admin')?->user()->country }}.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Details Modal -->
                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Personal Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row form-row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ ucfirst(Auth::guard('admin')->user()?->name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <input type="date" name="birthday"
                                                            value="{{ Auth::guard('admin')->user()?->birthday }}"
                                                            class="form-control" id="">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ Auth::guard('admin')->user()?->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input type="text" name="phone"
                                                            value="{{ Auth::guard('admin')->user()?->phone }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>About Me</label>
                                                        <textarea rows="5" cols="5" name="about_me" class="form-control"
                                                            placeholder="Enter text here">{{ Auth::guard('admin')->user()?->about_me }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Photo</label>
                                                        <input type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Address</span></h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ Auth::guard('admin')->user()?->address }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text"
                                                            value="{{ Auth::guard('admin')->user()?->city }}"
                                                            name="city" class="form-control" value="Miami">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" name="state"
                                                            value="{{ Auth::guard('admin')->user()?->state }}"
                                                            class="form-control" value="Florida">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input type="text" name="zip_code"
                                                            value="{{ Auth::guard('admin')->user()?->zip_code }}"
                                                            class="form-control" value="22434">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input type="text" name="country"
                                                            value="{{ Auth::guard('admin')->user()?->country }}"
                                                            class="form-control" value="United States">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save
                                                Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Details Modal -->

                    </div>


                </div>
                <!-- /Personal Details -->

            </div>
            <!-- /Personal Details Tab -->

            <!-- Change Password Tab -->
            <div id="password_tab" class="tab-pane fade">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <div class="row">
                            <div class="col-md-10 col-lg-6">
                                <form>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Change Password Tab -->

        </div>
    </div>
</div>
@endsection
@push('js')

@endpush
