@extends('layout')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/assets/plugins/fancybox/jquery.fancybox.min.css">
@endpush
@section('breadcrumb')
<x-breadcrumb title=" Doctor Profile" />
@endsection
@section('content')
@php
    $user=auth()->user();
@endphp
<div class="content" style="min-height: 149px;">
    <div class="container">

        <!-- Doctor Widget -->
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <img src="{{ asset($doctor?->photo ?? 'frontend/assets/img/doctors/doctor-thumb-02.jpg') }}" class="img-fluid" alt="User Image">
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name">{{ $doctor?->name }}</h4>
                            <p class="doc-speciality">{{ $doctor->biography ??'BDS, MDS - Oral &amp; Maxillofacial Surgery' }}</p>
                            <p class="doc-department"><img src="{{ asset($doctor?->department->logo ?? 'frontend/assets/img/specialities/specialities-01.jpg') }}"
                                    class="img-fluid" alt="Speciality">{{ $doctor?->department->name }}</p>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating">(35)</span>
                            </div>
                            <div class="clinic-details">
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $doctor?->address_line_one }} - <a
                                        href="javascript:void(0);">Get Directions</a></p>
                                <ul class="clinic-gallery">
                                    @foreach ($clicnics as $clinic)
                                        @foreach (collect(json_decode($clinic?->images,true))->take(2) as $image)
                                        <li>
                                            <a href="{{ asset($image) }}" data-fancybox="gallery">
                                                <img src="{{ asset($image) }}" alt="Feature">
                                            </a>
                                        </li>
                                        @endforeach
                                    @endforeach

                                </ul>
                            </div>
                            <div class="clinic-services">
                                @php
                                    $services = json_decode($doctor?->profile?->services,true);
                                @endphp
                                @if($services)
                                    @foreach ($services as $service)
                                        <span>{{ $service['value'] }}</span>
                                    @endforeach

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="doc-info-right">
                        <div class="clini-infos">
                            <ul>
                                <li><i class="far fa-thumbs-up"></i> 99%</li>
                                <li><i class="far fa-comment"></i> 35 Feedback</li>
                                <li><i class="fas fa-map-marker-alt"></i> {{ $doctor?->city_name }}, {{ $doctor?->country_name }}</li>
                                <li><i class="far fa-money-bill-alt"></i> ${{ $doctor?->profile?->custom_price }} per visit </li>
                            </ul>
                        </div>
                        <div class="doctor-action">
                            <a href="javascript:void(0)" class="btn btn-white fav-btn">
                                <i class="far fa-bookmark"></i>
                            </a>
                            <a href="chat.html" class="btn btn-white msg-btn">
                                <i class="far fa-comment-alt"></i>
                            </a>
                            <a href="tel:{{ $doctor?->phone }}" class="btn btn-white call-btn"
                               >
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal"
                                data-target="#video_call">
                                <i class="fas fa-video"></i>
                            </a>
                        </div>
                        <div class="clinic-booking">
                            <a class="apt-btn" href="booking.html">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor Widget -->

        <!-- Doctor Details Tab -->
        <div class="card">
            <div class="card-body pt-0">

                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
                        </li>
                    </ul>
                </nav>
                <!-- /Tab Menu -->

                <!-- Tab Content -->
                <div class="tab-content pt-0">

                    <!-- Overview Content -->
                    <div role="tabpanel" id="doc_overview" class="tab-pane fade active show">
                        @if($doctor?->profile)
                        <div class="row">
                            <div class="col-md-12 col-lg-12">

                                <!-- About Details -->
                                <div class="widget about-widget">
                                    <h4 class="widget-title">About Me</h4>
                                    <p>{{ $doctor?->profile?->about_me ?? 'No Data Found' }}</p>
                                </div>
                                <!-- /About Details -->

                                <!-- Education Details -->
                                <div class="widget education-widget">
                                    <h4 class="widget-title">Education</h4>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @php
                                                $degrees = json_decode($doctor?->profile?->degree ??'[]',true);
                                                $completion_year=json_decode($doctor?->profile?->completion_year ?? '[]',true);
                                            @endphp
                                            @forelse (json_decode($doctor?->profile?->collage ??'[]',true) as $index => $collage)
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">
                                                            {{ $collage }}
                                                        </a>
                                                        <div>{{ $degrees[$index] }}</div>
                                                        <span class="time">{{ $completion_year[$index] }}</span>

                                                    </div>
                                                </div>
                                            </li>
                                            @empty
                                            <p>{{ __('No Data Found') }}</p>
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                                <!-- /Education Details -->

                                <!-- Experience Details -->
                                <div class="widget experience-widget">
                                    <h4 class="widget-title">Work &amp; Experience</h4>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @php
                                                $start_year=json_decode($doctor?->profile?->experience_from ?? '[]',true);
                                                $end_year=json_decode($doctor?->profile?->experience_to ?? '[]',true);
                                            @endphp
                                            @forelse(json_decode($doctor?->profile?->hospital_name ??'[]',true) as $index => $hospital_name)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{ $hospital_name }}</a>
                                                            <span class="time">{{ date('Y', strtotime($start_year[$index])) }} - {{ $end_year[$index] == null ? "" : date('Y', strtotime($end_year[$index])) }}
                                                            {{ $end_year[$index] == null ? "Present ".'('.number_format(Carbon\Carbon::parse($start_year[$index])->diffInYears(Carbon\Carbon::now())). " years)" : '('.number_format(Carbon\Carbon::parse($start_year[$index])->diffInYears($end_year[$index])). " years)" }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <p>{{ __('No Data Found') }}</p>
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                                <!-- /Experience Details -->

                                <!-- Awards Details -->
                                <div class="widget awards-widget">
                                    <h4 class="widget-title">Awards</h4>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @php
                                                $awards_year=json_decode($doctor?->profile?->award_year ?? '[]' ,true);
                                                $award_deatils=json_decode($doctor?->profile?->memberships ?? '[]' ,true);
                                            @endphp
                                            @forelse(json_decode($doctor?->profile?->awards ?? '[]',true) as  $award)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">{{ $awards_year[$loop?->index] ?? 'N/A' }}</p>
                                                            <h4 class="exp-title">{{ $award }}</h4>
                                                            <p>{{ $award_deatils[$loop?->index] ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <p>{{ __('No Data Found') }}</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Awards Details -->

                                <!-- Services List -->
                                <div class="service-list">
                                    <h4>Services</h4>
                                    <ul class="clearfix">
                                        @forelse(json_decode($doctor?->profile?->services ??'[]',true) as $service)
                                            <li>{{ $service['value'] }} </li>
                                        @empty
                                            <p>{{ __('No Data Found') }}</p>
                                        @endforelse
                                    </ul>
                                </div>
                                <!-- /Services List -->

                                <!-- Specializations List -->
                                <div class="service-list">
                                    <h4>Specializations</h4>
                                    <ul class="clearfix">
                                        @forelse(json_decode($doctor?->profile?->specialization ?? '[]',true) as $specializ)
                                            <li>{{ $specializ['value'] }}</li>
                                        @empty
                                            <p>{{ __('No Data Found') }}</p>
                                        @endforelse
                                    </ul>
                                </div>
                                <!-- /Specializations List -->

                            </div>
                        </div>
                        @else
                        <div class="card card-table flex-fill">
                            <div class="card-header">
                                <h4 class="card-title text-center">No Profile Data Found</h4>
                            </div>
                        </div>
                        @endif

                    </div>
                    <!-- /Overview Content -->

                    <!-- Locations Content -->
                    <div role="tabpanel" id="doc_locations" class="tab-pane fade ">

                        @forelse($clicnics as $clicnic)
                        <!-- Location List -->
                        <div class="location-list">
                            <div class="row">
                                <!-- Clinic Content -->
                                <div class="col-md-6">
                                    <div class="clinic-content">
                                        <h4 class="clinic-name"><a href="#">{{ $clicnic?->name }}</a></h4>
                                        <p class="doc-speciality">{{ $doctor?->biography }}</p>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="d-inline-block average-rating">(4)</span>
                                        </div>
                                        <div class="clinic-details mb-0">
                                            <h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i>{{ $clicnic?->address }}<br><a
                                                    href="javascript:void(0);">Get Directions</a></h5>
                                            <ul>
                                                @forelse(json_decode($clicnic?->images) as $image)
                                                <li>
                                                    <a href="{{ asset($image) }}"
                                                        data-fancybox="gallery2">
                                                        <img src="{{ asset($image) }}"
                                                            alt="Feature Image">
                                                    </a>
                                                </li>
                                                @empty
                                                    <p>{{ __('No Data Found') }}</p>
                                                @endforelse

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Content -->

                                <!-- Clinic Timing -->
                                <div class="col-md-4">
                                @if($scheduleTimings->isNotEmpty())
                                    <div class="clinic-timing">
                                        @foreach ($scheduleTimings->where('clinic_id', $clicnic->id) as $time)
                                            @php
                                                $end_time=json_decode($time->end_time,true);
                                                // print_r($end_time);
                                            @endphp
                                            <div>
                                                <p class="timings-days">
                                                    <span>{{ $time->day_of_week }}</span>
                                                </p>
                                                @foreach (json_decode($time->start_time,true) as $i=>$showTitme)
                                                    @if($time->is_active == 1)
                                                        <p class="timings-times">
                                                            <span>{{ date('h:i A', strtotime($showTitme)) }} - {{ date('h:i A', strtotime($end_time[$i])) }}</span>
                                                        </p>
                                                    @else
                                                        <p class="timings-times">
                                                            {{ __('Off Day') }}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                <div class="clinic-timing">
                                    <p class="timings-times">
                                        {{ __('No Data Found') }}
                                    </p>
                                </div>
                                @endif
                                <!-- /Clinic Timing -->

                                <div class="col-md-2">
                                    <div class="consult-price">
                                       ${{ $doctor?->profile?->custom_price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <h4 class="card-title text-center">No Profile Data Found</h4>
                        @endforelse
                        <!-- /Location List -->

                    </div>
                    <!-- /Locations Content -->

                    <!-- Reviews Content -->
                    <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                        <!-- Review Listing -->
                        <div class="widget review-listing">
                            <ul class="comments-list">

                                <!-- Comment List -->
                                @if($doctor?->doctorReviews->where('is_approved', 1)->isNotEmpty())
                                    @foreach($doctor?->doctorReviews->where('is_approved', 1) as $review)
                                        <li>
                                            <div class="comment">
                                                <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                    src="{{ asset($review->user?->photo ?? 'frontend/assets/img/doctors/doctor-thumb-02.jpg') }}">
                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span class="comment-author">{{ $review->user?->name }}</span>
                                                        <span class="comment-date">Reviewed {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                                        <div class="review-count rating">
                                                            @php
                                                                $rating=$review->rating;
                                                                $fullstar=floor($rating);
                                                                $emptyStar=5-$fullstar;
                                                            @endphp
                                                            @for ($i = 0; $i < $fullstar; $i++)
                                                                <i class="fas fa-star filled"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < $emptyStar; $i++)
                                                            <i class="fas fa-star"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <p class="comment-content">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                @else
                                    <h4 class="card-title text-center">No Review Data Found</h4>
                                @endif

                            </ul>

                            <!-- Show All -->
                            @if($doctor?->doctorReviews->where('is_approved', 1)->isNotEmpty())
                            <div class="all-feedback text-center">
                                <a href="#" class="btn btn-primary btn-sm">
                                    {{ __('Show all feedback') }} <strong>({{ $doctor?->doctorReviews->where('is_approved', 1)->count() }})</strong>
                                </a>
                            </div>
                            @endif
                            <!-- /Show All -->

                        </div>
                        <!-- /Review Listing -->

                        <!-- Write Review -->
                        <div class="write-review">
                            <h4>{{ __('Write a review for') }} <strong>{{ $doctor->name }}</strong></h4>

                            <!-- Write Review Form -->
                            <form action="{{ route('review.store', $doctor->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>{{ __('Review') }}</label>
                                    <div class="star-rating">
                                        <input id="star-5" type="radio" name="rating" value="5">
                                        <label for="star-5" title="5 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-4" type="radio" name="rating" value="4">
                                        <label for="star-4" title="4 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-3" type="radio" name="rating" value="3">
                                        <label for="star-3" title="3 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-2" type="radio" name="rating" value="2">
                                        <label for="star-2" title="2 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-1" type="radio" name="rating" value="1">
                                        <label for="star-1" title="1 star">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Your review</label>
                                    <textarea id="review_desc" maxlength="300" name="comment" class="form-control"></textarea>

                                    <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span
                                                id="chars">300</span> characters remaining</small></div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                </div>
                            </form>
                            <!-- /Write Review Form -->

                        </div>
                        <!-- /Write Review -->

                    </div>
                    <!-- /Reviews Content -->

                    <!-- Business Hours Content -->
                    <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                        <div class="row">
                            @if($doctor?->scheduleTimings->isNotEmpty())
                            <div class="col-md-6 offset-md-3">

                                <!-- Business Hours Widget -->
                                <div class="widget business-widget">
                                    <div class="widget-content">
                                        <div class="listing-hours">
                                            <div class="listing-day current">
                                                <div class="day">{{ Carbon\Carbon::now()->format('l') }} <span>{{ Carbon\Carbon::now()->format('d M Y') }}</span></div>
                                                @if($todayHours)

                                                @if($todayHours->is_active == 1)
                                                    <div class="time-items">
                                                        <span class="open-status">
                                                            @php
                                                                $start_time=json_decode($todayHours->start_time,true);
                                                            @endphp

                                                            <span class="badge bg-{{ $isOpen == 1 ? 'success' : 'danger' }}-light">
                                                                {{ $isOpen == 1 ? 'Open Now' : 'Closed' }}
                                                            </span>
                                                            @if($open == 1)
                                                                Open Will Be {{ date('h:i A', strtotime($start_time[0])) }}
                                                            @else
                                                                Closed
                                                            @endif

                                                        </span>

                                                        @foreach(json_decode($todayHours->start_time,true) as $i=>$hour)
                                                            @php
                                                                $end=json_decode($todayHours->end_time,true);
                                                            @endphp
                                                            <span class="time">{{ date('h:i A', strtotime($hour)) }} - {{ date('h:i A', strtotime($end[$i])) }}</span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="time-items">
                                                        <span class="open-status"><span class="badge bg-danger-light">Off day</span></span>
                                                    </div>
                                                @endif
                                                 @endif
                                            </div>
                                            @foreach($doctor->scheduleTimings as $i=>$time)
                                                @php
                                                    $endTime=json_decode($time->end_time,true);
                                                @endphp
                                                <div class="listing-day">
                                                    <div class="day">{{ $time->day_of_week }}</div>
                                                        <div class="time-items">
                                                            @if($time->is_active == 1)
                                                                @foreach (json_decode($time->start_time,true) as $key => $startTime)

                                                                    <span class="time">{{ date('h:i A', strtotime($startTime)) }} - {{ date('h:i A', strtotime($endTime[$key])) }}</span>

                                                                @endforeach
                                                            @else
                                                                <span class="time">{{ __('Off Day') }}</span>
                                                            @endif
                                                        </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /Business Hours Widget -->

                            </div>
                            @else
                                <div class="col-12">
                                    <h4 class="card-title text-center">{{ __('No Business Hours Found') }}</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /Business Hours Content -->

                </div>
            </div>
        </div>
        <!-- /Doctor Details Tab -->

    </div>
</div>

@endsection
@push('js')
    <script src="{{ asset('frontend/assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endpush
