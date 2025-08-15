@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="User Profile" />
@endsection
@section('content')
@php
    $user = auth()->user();
@endphp
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Profile Sidebar -->
            @include('doctor.doctor_sidebar')
            <!-- /Profile Sidebar -->
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">

                        <!-- Profile Settings Form -->
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row form-row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <div class="change-avatar">
                                            <div class="profile-img">
                                                <img id="profile_image" src="{{ $user->photo == null ? asset('frontend/assets/img/doctors/doctor-thumb-02.jpg') : asset($user->photo) }}" alt="User Image">
                                            </div>
                                            <div class="upload-img">
                                                <div class="change-photo-btn">
                                                    <span><i class="fa fa-upload"></i> {{ __('Upload Photo') }}</span>
                                                    <input type="file" name="profile_image" onclick="document.getElementById('profile_image').src = window.URL.createObjectURL(this.files[0])" class="upload">
                                                </div>
                                                <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of
                                                    2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('First Name') }}</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user?->name) }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Last Name') }}</label>
                                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user?->last_name) }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Date of Birth') }}</label>
                                        <div class="">
                                            <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $user?->birthday) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Blood Group') }}</label>
                                        <select class="form-control" name="blood_group">
                                            <option value="">Select Blood Group</option>
                                            <option @selected($user->blood_group == 'a-') value="a-">A-</option>
                                            <option @selected($user->blood_group == 'a+') value="a+">A+</option>
                                            <option @selected($user->blood_group == 'b-') value="b-">B-</option>
                                            <option @selected($user->blood_group == 'b+') value="b+">B+</option>
                                            <option @selected($user->blood_group == 'ab-') value="ab-">AB-</option>
                                            <option @selected($user->blood_group == 'ab+') value="ab+">AB+</option>
                                            <option @selected($user->blood_group == 'o-') value="o-">O-</option>
                                            <option @selected($user->blood_group == 'o+') value="o+">O+</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Email ID') }}</label>
                                        <input type="email" readonly class="form-control" value="{{  $user?->email }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Phone Number') }}</label>
                                        <input type="text" name="phone" value="{{ old('phone', $user?->phone) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('Address') }}</label>
                                        <input type="text" name="address" class="form-control" value="{{ old('address', $user?->address_line_one) }}">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <select class="form-control s" name="country" id="country" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            @foreach ($countries as $country)
                                            <option @selected(auth()->user()->country_id == $country->id)
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <select class="form-control s" name="city" id="city"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            @if(auth()->user()->city_id != null)
                                            @foreach ($cities as $city)
                                            <option @selected(auth()->user()->city_id == $city->id)
                                                value="{{ $city->id }}">{{ $city->name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <select class="form-control s"  name="state" data-select2-id="1"
                                            id="state" tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            @foreach ($states as $state)
                                            <option @selected(auth()->user()->state_id == $state->id)
                                                value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Zip Code') }}</label>
                                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user?->postal_code) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                        <!-- /Profile Settings Form -->

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
@push('js')
<script>
    $(document).ready(function () {

        $('#country').on('change', function () {
            let id = $(this).val();
            let option = $('#city');
            let url = "{{ route('doctor.get.city', ':id') }}";
            url = url.replace(":id", id);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {

                    let html = "";
                    if (data.length > 0) {
                        data.forEach(function (city) {
                            html +=
                                `<option value="${city.id}">${city.name}</option>`;

                        })
                    } else {
                        html = `<option value="">No City Found</option>`;
                    }
                    option.html(html);
                }
            })
        })
        $('#city').on('change', function () {
            let val = $(this).val();
            let option = $('#state');
            let url = "{{ route('doctor.get.state', ':id') }}";
            url = url.replace(":id", val);
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    let html = "";
                    if (data.length > 0) {
                        data.forEach(function (state) {
                            html +=
                                `<option value="${state.id}">${state.name}</option>`;

                        })
                    } else {
                        html = `<option value="">No State Found</option>`;
                    }
                    option.html(html);
                }
            })
        })

    });

</script>
@endpush
