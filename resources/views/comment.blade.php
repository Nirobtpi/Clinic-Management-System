@extends('layout')
@section('breadcrumb')
    <x-breadcrumb title="Booking" />
@endsection
@section('content')
    <div class="content" style="min-height: 149px;">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="comment_wrapper">
                                <h3 class="mb-4">Comment List</h3>
                                <ul class="comments-list list-unstyled">
                                    @forelse($comments as $comment)
                                        <li class="mb-4">
                                            <div class="d-flex">
                                                <img src="{{ asset('frontend/assets/img/patients/patient1.jpg') }}"
                                                    alt="User Avatar" class="rounded-circle me-3" width="50"
                                                    height="50">
                                                <div class="flex-grow-1 ml-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-1 fw-bold">Nirob</h6>
                                                        <small
                                                            class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </div>

                                                    <p class="mb-3">{{ $comment->comment }}</p>
                                                    <div>
                                                        <button class="btn btn-sm btn-outline-primary me-2">
                                                            <i class="fas fa-thumbs-up"></i> Like
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-reply"></i> Reply
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <hr class="my-3">
                                    @empty
                                        <li class="text-center text-muted py-4">
                                            <p>No comments yet. Be the first to comment!</p>
                                        </li>
                                    @endforelse
                                </ul>
                                @if($comments->hasMorePages())
                                    <div class="text-center mt-3" id="button_wrapper">
                                        <button id="loadMoreBtn" class="btn btn-primary" id="loadMoreBtn"
                                            data-next_page="{{ $comments->nextPageUrl() }}">
                                            Load More
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')

    <script>
        $(document).ready(function() {
            $(document).on('click', '#loadMoreBtn', function(e) {
                e.preventDefault();
                var nextPageUrl = $(this).data('next_page');
                $btn = $(this);
                $btn.prop('disabled', true);
                $btn.text('Loading...');


                if (nextPageUrl) {
                    $.ajax({
                        url: nextPageUrl,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            console.log('Response:', response);
                            $btn.prop('disabled', false);
                            $btn.text('Load More');

                            // Append the HTML directly from response.html
                            if (response.html) {
                                $('.comments-list').append(response.html);
                            }

                            // Update the next page URL or remove button
                            if (response.has_more_page && response.has_pagination) {
                                // Remove old button and create new one
                                $('#button_wrapper').html(
                                    '<button id="loadMoreBtn" class="btn btn-primary" data-next_page="' +
                                    response.has_more_page + '">Load More</button>'
                                );
                            } else {
                                $('#button_wrapper').remove();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            console.error('Response:', xhr.responseText);
                            alert('Failed to load more comments.');
                            $btn.prop('disabled', false);
                            $btn.text('Load More');
                        }
                    });
                }
            });
        });
    </script>

@endpush
