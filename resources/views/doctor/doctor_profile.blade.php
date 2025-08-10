@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Doctor Profile" />
@endsection
@section('content')
<!-- Page Content -->
<div class="content" style="transform: none; min-height: 149px;">
    <div class="container-fluid" style="transform: none;">

        <div class="row" style="transform: none;">
            @include('doctor.doctor_sidebar')
            <div class="col-md-7 col-lg-8 col-xl-9">

                <!-- Basic Information -->
                <form action="{{ route('doctor.profile.update', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Information</h4>
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="change-avatar">
                                            <div class="profile-img">
                                                <img id="blah"
                                                    src="{{ auth()->user()->photo == "" ? asset('frontend/assets/img/doctors/doctor-thumb-02.jpg'): asset(auth()->user()->photo) }}"
                                                    alt="User Image">
                                            </div>
                                            <div class="upload-img">
                                                <div class="change-photo-btn">
                                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                    <input type="file" name="photo"
                                                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                                        class="upload">
                                                </div>
                                                <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of
                                                    2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ auth()->user()->name }}" name="name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                                            class="form-control" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" value="{{ auth()->user()->phone }}" name="phone"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control s" name="gender" data-select2-id="1" tabindex="-1"
                                            aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            <option @selected(auth()->user()->gender == "male") value="male">Male
                                            </option>
                                            <option @selected(auth()->user()->gender == "female") value="female">Female
                                            </option>
                                            <option @selected(auth()->user()->gender == "other") value="other">Other
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Blood Group</label>
                                        <select class="form-control s" name="blood_group" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            <option @selected(auth()->user()->blood_group == "a+") value="a+">A+
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "a-") value="a-">A-
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "b+") value="b+">B+
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "b-") value="b-">B-
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "o+") value="o+">O+
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "o-") value="o-">O-
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "ab+") value="ab+">AB+
                                            </option>
                                            <option @selected(auth()->user()->blood_group == "ab-") value="ab-">AB-
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control s" name="department" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">
                                            <option>Select</option>
                                            @foreach($departments as $dept)
                                            <option @selected(auth()->user()->department_id == $dept->id)
                                                value="{{ $dept->id }}">{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" name="birthday"
                                            value="{{ auth()->user()->birthday }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Postal Code</label>
                                        <input type="text" name="postal_code" value="{{ auth()->user()->postal_code }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Basic Information -->
                    <!-- Contact Details -->
                    <div class="card contact-card">
                        <div class="card-body">
                            <h4 class="card-title">Contact Details</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address Line 1</label>
                                        <input type="text" name="address_line_one"
                                            value="{{ auth()->user()->address_line_one }}" class="form-control">
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
                                        <select class="form-control s" disabled name="city" id="city"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            @if(auth()->user()->city_id != null)
                                            @foreach ($cities as $city)
                                            <option @selected(auth()->user()->city_id == $city->id)
                                                value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <select class="form-control s" disabled name="state" data-select2-id="1"
                                            id="state" tabindex="-1" aria-hidden="true">
                                            <option data-select2-id="3">Select</option>
                                            @foreach ($states as $state)
                                            <option @selected(auth()->user()->state_id == $state->id)
                                                value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Contact Details -->
                    <!-- About Me -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Me</h4>
                            <div class="form-group mb-0">
                                <label>Biography</label>
                                <textarea class="form-control" name="biography"
                                    rows="5">{{ auth()->user()->biography }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section submit-btn-bottom">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
                <!-- /About Me -->

                <!-- Clinic Info -->
                <form action="{{ route('doctor.profile.update.post', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Clinic Info</h4>
                            @php
                                $clinicNames = json_decode($doctor_profile->clinic_name) ?? [];
                                $clinicAddresses = json_decode($doctor_profile->clinic_address) ?? [];
                            @endphp
                           @foreach ($clinicNames as $index => $clinic)
                            <div id="clinic-wrapper">
                                <div class="row form-row clinic-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Clinic Name</label>
                                            <input type="text" value="{{ old('clinic_name', $clinic ?? '') }}" class="form-control" name="clinic_name[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Clinic Address</label>
                                            <input type="text"
                                                value="{{ old('clinic_address', $clinicAddresses[$index] ?? '') }}"
                                                class="form-control" name="clinic_address[]">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row clinic-images-wrapper">
                                            <div class="col-md-8 col-sm-12">
                                                <div class="form-group ">
                                                    <label>Clinic Images</label>
                                                    <input type="file"
                                                        onchange="document.getElementsByClassName('clinic_images')[0].src = window.URL.createObjectURL(this.files[0])"
                                                        class="form-control mb-3" name="clinic_images[]">
                                                    <img class="clinic_images" width="50"
                                                        src="{{ asset($doctor_profile->clinic_images ?? '') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <a href="javascript:void(0);" class="add-clinic-image"><i
                                                        class="fa fa-plus-circle"></i> Add More Image</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);"  class="remove-clinic mb-3"><i class="fa fa-minus-circle"></i> Remove</a>
                                </div>
                            </div>
                            @endforeach

                            <div class="add-more mt-3">
                                <a href="javascript:void(0);" class="add-clinic">
                                    <i class="fa fa-plus-circle"></i> Add More
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- /Clinic Info -->

                    <!-- Pricing -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pricing</h4>

                            <div class="form-group mb-0">
                                <div id="pricing_select">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="price_free" name="rating_option"
                                            class="custom-control-input" value="price_free" checked="">
                                        <label class="custom-control-label" for="price_free">Free</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="price_custom" name="rating_option" value="custom_price"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="price_custom">Custom Price (per
                                            hour)</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row custom_price_cont" id="custom_price_cont" style="display: none;">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="custom_rating_input"
                                        name="custom_rating_count" value="" placeholder="20">
                                    <small class="form-text text-muted">Custom price you can add</small>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /Pricing -->

                    <!-- Services and Specialization -->
                    <div class="card services-card">
                        <div class="card-body">
                            <h4 class="card-title">Services and Specialization</h4>
                            <div class="form-group">
                                <label>Services</label>
                                <input type="text" class="form-control" id="services" name="services"
                                    placeholder="Enter Services">
                            </div>
                        </div>
                    </div>
                    <!-- /Services and Specialization -->

                    <!-- Education -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Education</h4>
                            <div class="education-info">
                                <div class="row form-row education-cont">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Degree</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>College/Institute</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Year of Completion</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i>
                                    Add
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Education -->

                    <!-- Experience -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Experience</h4>
                            <div class="experience-info">
                                <div class="row form-row experience-cont">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Hospital Name</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>From</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i>
                                    Add More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Experience -->

                    <!-- Awards -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Awards</h4>
                            <div class="awards-info">
                                <div class="row form-row awards-cont">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Awards</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Awards -->

                    <!-- Memberships -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Memberships</h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <div class="form-group">
                                            <label>Memberships</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-membership"><i class="fa fa-plus-circle"></i>
                                    Add
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Memberships -->

                    <!-- Registrations -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Registrations</h4>
                            <div class="registrations-info">
                                <div class="row form-row reg-cont">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Registrations</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Registrations -->

                    <div class="submit-section submit-btn-bottom">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->
@endsection
@push('js')
<script>
    var input = document.getElementById('services'); // get raw DOM element
    var tagify = new Tagify(input);


    document.querySelector('.add-clinic').addEventListener('click', function () {
        const wrapper = document.getElementById('clinic-wrapper');
        const firstClinic = wrapper.querySelector('.clinic-row');
        const newClinic = firstClinic.cloneNode(true);

        newClinic.querySelectorAll('input').forEach(input => input.value = '');
        wrapper.appendChild(newClinic);
    });

    $(document).ready(function () {

        $(document).on('click', '.add-clinic-image', function () {
            var newRow = `
            <div class="row clinic-image-row mt-2">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label>Clinic Images</label>
                        <input type="file" class="form-control" name="clinic_images[]">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 d-flex align-items-center">
                    <a href="javascript:void(0);" class="remove-clinic-image">
                        <i class="fa fa-times-circle"></i> Remove
                    </a>
                </div>
            </div>`;

            // $('.clinic-images-wrapper').append(newRow);
            $(this).closest('.clinic-images-wrapper').after(newRow);
        });

        // Remove image input row
    //    $(document).on('click', '.remove-clinic', function () {
    //         $(this).closest('.clinic-row').remove();
    //     });
    document.getElementById('clinic-wrapper').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-clinic') || event.target.closest('.remove-clinic')) {
            const clinicRow = event.target.closest('.clinic-row');
            const wrapper = document.getElementById('clinic-wrapper');
            const totalRows = wrapper.querySelectorAll('.clinic-row').length;

            if (clinicRow) {
                if (totalRows > 1) {
                    clinicRow.remove();
                } else {
                    alert('At least one clinic row is required.');
                }
            }
        }
        });

        $(document).on('click', '.remove-clinic-image', function () {
            $(this).closest('.clinic-image-row').remove();
        });

        $('#country').on('change', function () {
            let id = $(this).val();
            let option = $('#city');
            option.prop('disabled', false)
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
            option.prop('disabled', false);
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
