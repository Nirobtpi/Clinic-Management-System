@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Review" />
@endsection
@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <!-- Profile Sidebar -->
                    @include('doctor.doctor_sidebar')
                <!-- /Profile Sidebar -->
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="doc-review review-listing">

                        <!-- Review Listing -->
                        <ul class="comments-list">
                            @if($reviews->isNotEmpty())
                                @foreach($reviews as $review)
                                    <!-- Comment List -->
                                    <li>
                                        <div class="comment">
                                            <img class="avatar rounded-circle" alt="User Image"
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
                                                <div class="comment-reply">
                                                    <p class="recommend-btn">
                                                        <span>{{ __('Approve Comment') }}</span>
                                                        <a style="cursor: pointer" data-url="{{ route('status.update',$review->id) }}" class="like-btn">
                                                            <i class="far fa-thumbs-up"></i> {{ $review->is_approved == 1 ? __('Approved') : __('Pending') }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- /Comment List -->
                                @endforeach
                            @else
                             <li>
                                <div class="comment d-block">
                                    <h2  class="text-center">{{ __('No Data Found') }}</h2>
                                </div>
                             </li>
                            @endif

                        </ul>
                        <!-- /Comment List -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

</div>
<!-- /Main Wrapper -->
@endsection

@push('js')
   <script>
     $(document).on('click', '.like-btn', function () {
        var url = $(this).data('url');
        // alert(url);
        $.ajax({
            type: 'get',
            url: url,
            success: function (response) {
                if (response.status == 'success') {
                    toastr.success(response.message);
                } else {
                    toastr.error("Something went wrong!");
                }
            }

        })
    })
   </script>
@endpush
