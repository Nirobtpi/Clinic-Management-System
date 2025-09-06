@extends('layout')
@section('content')
<!-- Home Banner -->
<section class="section section-search">
    <div class="container-fluid">
        <div class="banner-wrapper">
            <div class="banner-header text-center">
                <h1>{{ __('Search Doctor, Make an Appointment') }}</h1>
                <p>{{ __('Discover the best doctors, clinic & hospital the city nearest to you.') }}</p>
            </div>

            <!-- Search -->
            <div class="search-box">
                <form action="templateshub.net">
                    <div class="form-group search-location">
                        <input type="text" class="form-control" placeholder="Search Location">
                        <span class="form-text">Based on your Location</span>
                    </div>
                    <div class="form-group search-info">
                        <input type="text" class="form-control"
                            placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
                        <span class="form-text">Ex : Dental or Sugar Check up etc</span>
                    </div>
                    <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
                        <span>Search</span></button>
                </form>
            </div>
            <!-- /Search -->

        </div>
    </div>
</section>
<!-- Clinic and Specialities -->
<section class="section section-specialities">
    <div class="container-fluid">
        <div class="section-header text-center">
            <h2>{{ __('Clinic and Specialities') }}</h2>
            <p class="sub-title">{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <!-- Slider -->
                <div class="specialities-slider slider">
                    @foreach ($departments as $department)
                    <!-- Slider Item -->
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="{{ asset($department->logo) }}" class="img-fluid" alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>{{ $department->name }}</p>
                        </div>
                    <!-- /Slider Item -->
                    @endforeach
                </div>
                <!-- /Slider -->

            </div>
        </div>
    </div>
</section>
<!-- Clinic and Specialities -->

<!-- Popular Section -->
<section class="section section-doctor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-header ">
                    <h2>{{ __('Book Our Doctor') }}</h2>
                    <p>{{ __('Lorem Ipsum is simply dummy text') }} </p>
                </div>
                <div class="about-content">
                    <p>{{ __('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.') }}</p>
                    <p>{{ __("web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes") }}</p>
                    <a href="javascript:;">Read More..</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="doctor-slider slider">

                    @foreach($doctors as $doctor)
                        <!-- Doctor Widget -->
                        <div class="profile-widget">
                            <div class="doc-img">
                                <a href="doctor-profile.html">
                                    <img class="img-fluid" alt="User Image" src="{{ asset($doctor->photo ?? 'frontend/assets/img/doctors/doctor-01.jpg') }}">
                                </a>
                                <a href="javascript:void(0)" class="fav-btn">
                                    <i class="far fa-bookmark"></i>
                                </a>
                            </div>
                            <div class="pro-content">
                                <h3 class="title">
                                    <a href="doctor-profile.html">{{ $doctor->name }}</a>
                                    @if($doctor->status == 'active')
                                    <i class="fas fa-check-circle verified"></i>
                                    @endif
                                </h3>
                                <p class="speciality">{{ $doctor->biography }}</p>
                                <div class="rating">
                                    @php
                                        $rating = $doctor->avg_rating;
                                        $fullstar = floor($rating);
                                        $halfstar = ceil($rating - $fullstar);
                                        $emptyStar = 5 - $fullstar - $halfstar;
                                    @endphp

                                    @for ($i = 0; $i < $fullstar; $i++)
                                        <i class="fas fa-star filled"></i>
                                    @endfor

                                    @if ($halfstar > 0)
                                       <i class="fas fa-star-half-alt"></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStar; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    <span class="d-inline-block average-rating">({{ number_format($doctor->avg_rating,1) }})</span>
                                </div>
                                <ul class="available-info">
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i> {{ $doctor->address_line_one }}
                                    </li>
                                    <li>
                                        <i class="far fa-clock"></i> Available on {{ implode(', ',$doctor->scheduleTimings->where('is_active','1')->pluck('day_of_week')->toArray()) }} days and off day {{  implode(', ',$doctor->scheduleTimings->where('is_active',0)->pluck('day_of_week')->toArray()) }}
                                    </li>
                                    <li>
                                        <i class="far fa-money-bill-alt"></i> ${{ $doctor?->profile?->custom_price ?? 'Free' }} per visit
                                        <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                                    </li>
                                </ul>
                                <div class="row row-sm">
                                    <div class="col-6">
                                        <a href="{{ route('user.doctor.profile', $doctor->id) }}" class="btn view-btn">{{ __('View Profile') }}</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('user.doctor.appointment', $doctor->id) }}" class="btn book-btn">{{ __('Book Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $doctor->id }}">
                                <input type="hidden" name="name" value="{{ $doctor->name }}">
                                <input type="hidden" name="price" value="{{ $doctor?->profile?->custom_price ?? 'Free' }}">
                                <input type="number" class="form-control" name="qty" value="1" min="1">
                                <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
                            </form> --}}
                        </div>
                        <!-- /Doctor Widget -->
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Popular Section -->

<!-- Availabe Features -->
<section class="section section-features">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 features-img">
                <img src="assets/img/features/feature.png" class="img-fluid" alt="Feature">
            </div>
            <div class="col-md-7">
                <div class="section-header">
                    <h2 class="mt-2">{{ __('Availabe Features in Our Clinic') }}</h2>
                    <p>{{ __('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.') }}</p>
                </div>
                <div class="features-slider slider">
                    <!-- Slider Item -->
                    <div class="feature-item text-center">
                        <img src="assets/img/features/feature-01.jpg" class="img-fluid" alt="Feature">
                        <p>Patient Ward</p>
                    </div>
                    <!-- /Slider Item -->

                    <!-- Slider Item -->
                    <div class="feature-item text-center">
                        <img src="assets/img/features/feature-02.jpg" class="img-fluid" alt="Feature">
                        <p>Test Room</p>
                    </div>
                    <!-- /Slider Item -->

                    <!-- Slider Item -->
                    <div class="feature-item text-center">
                        <img src="assets/img/features/feature-03.jpg" class="img-fluid" alt="Feature">
                        <p>ICU</p>
                    </div>
                    <!-- /Slider Item -->

                    <!-- Slider Item -->
                    <div class="feature-item text-center">
                        <img src="assets/img/features/feature-04.jpg" class="img-fluid" alt="Feature">
                        <p>Laboratory</p>
                    </div>
                    <!-- /Slider Item -->

                    <!-- Slider Item -->
                    <div class="feature-item text-center">
                        <img src="assets/img/features/feature-05.jpg" class="img-fluid" alt="Feature">
                        <p>Operation</p>
                    </div>
                    <!-- /Slider Item -->

                    <!-- Slider Item -->
                    <div class="feature-item text-center">
                        <img src="assets/img/features/feature-06.jpg" class="img-fluid" alt="Feature">
                        <p>Medical</p>
                    </div>
                    <!-- /Slider Item -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Availabe Features -->

@endsection
