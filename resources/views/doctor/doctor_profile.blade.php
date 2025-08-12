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
                            <div id="clinic-wrapper">
                                <div class="row form-row clinic-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Clinic Name</label>
                                            <select name="clinic_name[]" id="clinic" multiple="multiple"
                                                class="form-control clinic_name">
                                                @php
                                                $selectedClinics = json_decode($doctor_profile->clinic_id ?? '[]');
                                                @endphp
                                                @foreach ($clinics as $clinic)
                                                <option value="{{ $clinic->id }}" @if(in_array($clinic->id,
                                                    $selectedClinics)) selected @endif>{{ $clinic->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /Clinic Info -->

                    <!-- Pricing -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pricing</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Attach Your Price</label>
                                        <input type="text" name="price"
                                            value="{{ old('price', $doctor_profile->custom_price ?? '') }}"
                                            class="form-control">
                                    </div>
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
                                @php
                                $services = collect(json_decode($doctor_profile->services ?? '[]'));
                                $data = implode(', ', $services->pluck('value')->toArray());
                                @endphp
                                <input type="text" class="form-control" value="{{ old('services', $data) }}"
                                    id="services" name="services" placeholder="Enter Services">
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
                                        @php
                                        $education = json_decode($doctor_profile->degree ?? '[]');
                                        $college = json_decode($doctor_profile->collage ?? '[]');
                                        $completion_year = json_decode($doctor_profile->completion_year ?? '[]');
                                        @endphp
                                        @foreach ($education as $index => $edu)
                                        <div class="row form-row nirob align-items-center">
                                            <div class="col-12 col-md-{{ $index == 0 ? 12 : 10 }}">
                                                <div class="row form-row align-items-center">
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Degree</label>
                                                            <input type="text"
                                                                value="{{ old('degree.' . $index, $edu) }}"
                                                                name="degree[]" class="form-control">

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>College/Institute</label>
                                                            <input type="text"
                                                                value="{{ old('college.' . $index, $college[$index] ?? '') }}"
                                                                name="college[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="form-group">
                                                            <label>Year of Completion</label>
                                                            <input type="text"
                                                                value="{{ old('completion_year.' . $index, $completion_year[$index] ?? '') }}"
                                                                name="completion_year[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-danger remove {{ $index === 0 ? 'd-none' : '' }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i>
                                    Add More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Education -->

                    <!-- Experience -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Experience</h4>
                            @php
                            $hospital_name = json_decode($doctor_profile?->hospital_name ?? '[]');
                            $experience_from = json_decode($doctor_profile?->experience_from ?? '[]');
                            $experience_to = json_decode($doctor_profile?->experience_to ?? '[]');
                            $designation= json_decode($doctor_profile?->designation ?? '[]');
                            @endphp
                            <div class="experience-info">
                                <div class="row form-row experience-cont">
                                    @foreach($hospital_name as $index => $name)
                                    <div
                                        class="col-12 col-md-10 col-lg-11 {{ $index === 0 ? '' : 'experience-remove' }}">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Hospital Name</label>
                                                    <input type="text"
                                                        value="{{ old('hospital_name.' . $index, $name) }}"
                                                        name="hospital_name[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>From</label>
                                                    <input type="date"
                                                        value="{{ old('experience_from.' . $index, $experience_from[$index] ?? '') }}"
                                                        name="experience_from[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <input type="date"
                                                        value="{{ old('experience_to.' . $index, $experience_to[$index] ?? '') }}"
                                                        name="experience_to[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text"
                                                        value="{{ old('designation.' . $index, $designation[$index] ?? '') }}"
                                                        name="designation[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2 align-content-center">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-danger remove-experience {{ $index === 0 ? 'd-none' : '' }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
                            @php
                            $awards=json_decode($doctor_profile?->awards ?? '[]');
                            $award_year=json_decode($doctor_profile?->award_year ?? '[]');
                            @endphp
                            <div class="awards-info">
                                @foreach($awards as $index => $award)
                                <div class="row form-row awards-con delete">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Awards</label>
                                            <input type="text" value="{{ old('awards.' . $index, $award) }}"
                                                name="awards[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text"
                                                value="{{ old('award_year.' . $index, $award_year[$index] ?? '') }}"
                                                name="award_year[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 align-content-center">
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger remove-award {{ $index === 0 ? 'd-none' : '' }}"><i
                                                class="far fa-trash-alt"></i></a>
                                    </div>
                                </div>
                                @endforeach
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
                            <h4 class="card-title">{{ __('Memberships') }}</h4>
                            <div class="membership-info">
                                @php
                                $memberships=json_decode($doctor_profile?->memberships ?? '[]');
                                @endphp
                                @foreach($memberships as $index => $membership)
                                <div class="row form-row membership-cont delete">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <div class="form-group">
                                            <label>{{ __('Memberships') }}</label>
                                            <input type="text" value="{{ old('memberships.' . $index, $membership) }}"
                                                name="memberships[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 align-content-center">
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger remove-membership {{ $index === 0 ? 'd-none' : '' }}"><i
                                                class="far fa-trash-alt"></i></a>
                                    </div>
                                </div>
                                @endforeach
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
                                @php
                                $registrations=json_decode($doctor_profile?->registrations ?? '[]');
                                $registration_year=json_decode($doctor_profile?->registration_date ?? '[]');
                                @endphp
                                @foreach($registrations as $index => $registration)
                                <div class="row form-row reg-cont delete">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Registrations</label>
                                            <input type="text"
                                                value="{{ old('registrations.' . $index, $registration) }}"
                                                name="registrations[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text"
                                                value="{{ old('registration_year.' . $index, $registration_year[$index] ?? '') }}"
                                                name="registration_year[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2 align-content-center">
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger remove-registration {{ $index === 0 ? 'd-none' : '' }}"><i
                                                class="far fa-trash-alt"></i></a>
                                    </div>

                                </div>
                                @endforeach
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

    $(document).on('click', '.remove', function () {
        $(this).closest('.nirob').remove();
    });
    $(document).on('click', '.remove-experience', function () {
        $(this).closest('.experience-remove').remove();
    });
    $(document).on('click', '.remove-award', function () {
        $(this).closest('.delete').remove();
    });
    $(document).on('click', '.remove-membership', function () {
        $(this).closest('.delete').remove();
    });
    $(document).on('click', '.remove-registration', function () {
        $(this).closest('.delete').remove();
    });

    $(document).ready(function () {

        $('.clinic_name').select2();

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
