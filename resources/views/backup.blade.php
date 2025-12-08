@extends('layout')
@section('title')
    <title>{{ $post->title }}</title>
    <meta name="title" content="{{ $post?->title }}">
    <meta name="description" content="{!! strip_tags(clean($post?->title)) !!}">
@endsection

@php
    $userReaction = $post->like_dislike->firstWhere('user_id', auth()->id());
    $userType = $userReaction ? $userReaction->type : null;
@endphp

@section('body-content')
    <!-- forum-starts -->
    <section class="pt-[124px] pb-100">
        <div class="container">
            <div class="grid xl:grid-cols-12 gap-[50px]">
                <div class="xl:col-span-9">
                    <div class="flex items-center justify-between mb-30">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('frontend.forum.index') }}"
                                class="size-10 rounded-full border border-border flex items-center justify-center">
                                <span>
                                    <svg width="10" height="14" viewBox="0 0 10 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.30051 0.301012C8.49855 0.296656 8.69301 0.354063 8.85688 0.465339C9.02075 0.576616 9.14588 0.736262 9.21487 0.921939C9.28386 1.10762 9.29328 1.31015 9.24182 1.50143C9.19037 1.69271 9.0806 1.86312 8.92777 1.98913L3.09638 6.9848L8.92777 11.9787C9.03349 12.0564 9.12203 12.1551 9.18784 12.2686C9.25365 12.3821 9.29532 12.508 9.31023 12.6383C9.32514 12.7687 9.31298 12.9007 9.27451 13.0261C9.23603 13.1515 9.17207 13.2677 9.08663 13.3673C9.00119 13.4669 8.89611 13.5476 8.77798 13.6047C8.65984 13.6618 8.53119 13.6939 8.40008 13.6989C8.26898 13.704 8.13824 13.682 8.01605 13.6342C7.89387 13.5864 7.78287 13.5138 7.69002 13.4212L1.01361 7.70883C0.908764 7.61935 0.824573 7.5083 0.766843 7.38314C0.709112 7.25798 0.679217 7.12175 0.679217 6.98392C0.679217 6.84608 0.709112 6.70986 0.766842 6.5847C0.824573 6.45953 0.908763 6.34837 1.01361 6.2589L7.69001 0.541073C7.85867 0.391268 8.075 0.306319 8.30051 0.301012Z"
                                            fill="#273142" />
                                    </svg>
                                </span>
                            </a>
                            <h4>{{ $post->title }}</h4>
                        </div>
                        <h4>{{ $post->answers->count() }} {{ __('Reply') }}</h4>
                    </div>

                    <div class="border border-border p-4 sm:p-30 rounded-lg">
                        <div class="grid gap-6">
                            <!-- column-start -->
                            <div>
                                <div class="pb-6 border-b border-b-border">
                                    <div class="bg-opacity p-5 rounded-lg">
                                        <div
                                            class="flex justify-between items-center flex-wrap gap-5 border-b border-b-border pb-2.5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-[50px] rounded-full overflow-hidden">
                                                    <img src="{{ asset($post->user->image ?? $general_setting->default_avatar) }}"
                                                        alt="img" class="h-full w-full" />
                                                </div>
                                                <div>
                                                    <h5>{{ $post->user->name }}</h5>
                                                    <p class="text-14">{{ $post->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-5">
                                                <button class="p-3 py-1 text-primary rounded-[100px] border border-border">
                                                    {{ $post->category->name }}
                                                </button>
                                                <div class="flex items-center gap-5 forum-like-dislike-container">
                                                    <button data-user_reaction="{{ $userType }}"
                                                        class="forum-like-button flex items-center gap-1"
                                                        data-model_type="post" data-post_id="{{ $post->id }}"
                                                        data-type="1">
                                                        <span data-like_count="{{ $post->like_count }}"
                                                            class="text-16 like-count text-headline">{{ $post->like_count }}</span>
                                                        <span
                                                            class="forum-like-icon {{ $post->like_dislike->contains(function ($like) {
                                                                return $like->type == 1 && $like->user_id == auth()->id();
                                                            })
                                                                ? 'text-primary'
                                                                : '' }}">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M0.599454 8.78711C0.272696 8.78711 0.0078125 9.05203 0.0078125 9.37875V18.0685C0.0078125 18.3953 0.272735 18.6602 0.599454 18.6602H4.16403V8.78711H0.599454Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M19.993 12.0542C19.993 11.3032 19.5894 10.6446 18.9878 10.2839C19.2183 9.951 19.3535 9.54721 19.3535 9.11256C19.3535 7.97533 18.4282 7.0501 17.291 7.0501H12.9372C13.0706 6.44541 13.2531 5.53802 13.3802 4.58814C13.7109 2.11622 13.4849 0.745317 12.669 0.27387C12.1603 -0.0199973 11.6118 -0.0796068 11.1247 0.105862C10.7483 0.249222 10.24 0.601684 9.95036 1.46672L8.80606 4.46286C8.22594 5.89556 6.44942 7.39967 5.34766 8.23135V18.9219C7.38961 19.6374 9.5204 20 11.6942 20H16.4382C17.5755 20 18.5007 19.0748 18.5007 17.9376C18.5007 17.5393 18.3872 17.1671 18.1909 16.8515C18.8785 16.5166 19.3534 15.8106 19.3534 14.9959C19.3534 14.5612 19.2182 14.1575 18.9877 13.8246C19.5894 13.4639 19.993 12.8053 19.993 12.0542Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <button data-user_reaction="{{ $userType }}"
                                                        class="forum-dislike-button flex items-center gap-1"
                                                        data-model_type="post" data-post_id="{{ $post->id }}"
                                                        data-type="0">
                                                        <span data-dislike_count="{{ $post->dislike_count }}"
                                                            class="text-16 dislike-count text-headline">{{ $post->dislike_count }}</span>
                                                        <span
                                                            class="forum-dislike-icon {{ $post->like_dislike->contains(function ($like) {
                                                                return $like->type == 0 && $like->user_id == auth()->id();
                                                            })
                                                                ? 'text-primary'
                                                                : 'text-[#686E7D]' }}">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M1.39832 11.2722C1.9443 11.9302 2.79914 12.3389 3.6293 12.3389L5.82535 12.3389C5.33113 13.1265 4.95918 13.919 4.7325 14.6737C4.3866 15.8254 4.39871 16.8293 4.76754 17.5769C5.18297 18.419 6.02484 18.8828 7.13797 18.8828C7.39113 18.8828 7.6193 18.7301 7.71578 18.496C8.5825 16.3938 10.8432 13.3723 12.9732 11.3819C13.1905 12.1368 13.887 12.6909 14.711 12.6909L17.3868 12.6909C18.384 12.6909 19.1953 11.8796 19.1953 10.8824L19.1953 2.92746C19.1953 1.93023 18.384 1.11891 17.3868 1.11891L14.711 1.11891C14.1009 1.11891 13.5609 1.42285 13.2331 1.88691C12.7373 1.40992 12.0801 1.11891 11.3599 1.11891L4.62234 1.11891C3.8775 1.11891 3.21422 1.43606 2.70414 2.03606C2.28367 2.5307 1.98504 3.19895 1.84058 3.96852L0.847499 9.25863C0.714257 9.9684 0.909883 10.6835 1.39832 11.2722ZM14.1525 2.92742C14.1525 2.61945 14.403 2.36887 14.711 2.36887L17.3868 2.36887C17.6947 2.36887 17.9453 2.61945 17.9453 2.92742L17.9453 10.8823C17.9453 11.1903 17.6947 11.4409 17.3868 11.4409L14.711 11.4409C14.403 11.4409 14.1525 11.1903 14.1525 10.8823L14.1525 2.92742ZM2.07605 9.48926L3.0691 4.1991C3.23519 3.3143 3.73047 2.36887 4.62238 2.36887L11.3599 2.36887C12.2105 2.36887 12.9024 3.13816 12.9024 4.08379L12.9024 9.7768C10.5465 11.7326 7.90813 15.0915 6.74336 17.6021C6.12191 17.4969 5.95121 17.1509 5.88852 17.0239C5.48285 16.2016 5.81953 14.3082 7.5173 12.0943C7.66211 11.9055 7.68711 11.6508 7.58184 11.4374C7.47656 11.2241 7.2593 11.0889 7.02133 11.0889L3.62926 11.0889C3.16832 11.0889 2.6702 10.8476 2.36027 10.474C2.18578 10.2636 1.99477 9.92207 2.07605 9.48926Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <button class="flex items-center gap-1">
                                                        <span class="text-headline">
                                                            @include('forum::frontend.forum.svg.icon_four')
                                                        </span>
                                                        <span class="text-16 text-headline">{{ __('Share') }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="my-5">
                                            <a href="javascript:void(0)"
                                                class="text-16 text-headline font-medium inline-block mb-3">{{ $post->title }}</a>
                                            <p class="">
                                                {!! clean($post->body) !!}
                                            </p>
                                        </div>

                                        <div class="flex gap-2.5 flex-wrap">
                                            <div class="size-[136px] rounded overflow-hidden relative group">
                                                <div
                                                    class="w-full h-full flex justify-center items-center top-0 left-0 absolute bg-[linear-gradient(180deg,_rgba(0,_0,_0,_0)_0%,_rgba(0,_0,_0,_0.8)_100%)] cursor-pointer">
                                                    <span
                                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 12L12 15M12 15L15 12M12 15L12 3" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M7.5 9L7 9C4.79086 9 3 10.7909 3 13L3 17C3 19.2091 4.79086 21 7 21L17 21C19.2091 21 21 19.2091 21 17L21 13C21 10.7909 19.2091 9 17 9L16.5 9"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <p class="text-14 text-white font-medium absolute bottom-2 right-2 z-[10]">
                                                    1.3MB
                                                </p>
                                                <img src="./assets/img/chatbox-img-1.png" alt="" class="" />
                                            </div>
                                            <div class="size-[136px] rounded overflow-hidden relative group">
                                                <div
                                                    class="w-full h-full flex justify-center items-center top-0 left-0 absolute bg-[linear-gradient(180deg,_rgba(0,_0,_0,_0)_0%,_rgba(0,_0,_0,_0.8)_100%)] cursor-pointer">
                                                    <span
                                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 12L12 15M12 15L15 12M12 15L12 3" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M7.5 9L7 9C4.79086 9 3 10.7909 3 13L3 17C3 19.2091 4.79086 21 7 21L17 21C19.2091 21 21 19.2091 21 17L21 13C21 10.7909 19.2091 9 17 9L16.5 9"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <p class="text-14 text-white font-medium absolute bottom-2 right-2 z-[10]">
                                                    1.5MB
                                                </p>
                                                <img src="./assets/img/chatbox-img-2.png" alt=""
                                                    class="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <h6 class="text-16 mb-3.5">{{ __('You can Reply') }}</h6>
                                        <form id="answer_form" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="error_wrapper body">
                                                <div class="bg-opacity p-5 rounded-lg border border-border">
                                                    <div
                                                        class="w-full bg-opacity flex-col flex rounded text-black bg-light outline-none focus:outline-none focus:border-tu-green transition-all duration-300">
                                                        <input type="text" name="body"
                                                            class="bg-transparent form_input_error check_validation error:!border-error-border outline-none w-full pb-5"
                                                            placeholder="{{ __('Write something here') }}..." />
                                                        <div class="flex gap-2">
                                                            <ul id="fileList" class="flex gap-2 flex-wrap"></ul>
                                                            <ul id="ImageList" class="flex gap-2 flex-wrap"></ul>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-end gap-5">
                                                        <div class="flex items-center gap-3.5 mr-1.5">

                                                            <label for="image-attach"
                                                                class="text-paragraph hover:text-primary cursor-pointer">
                                                                @include('forum::frontend.forum.svg.icon_two')
                                                            </label>
                                                            <input type="file" name="image[]" id="image-attach"
                                                                multiple="" accept="image/*"
                                                                class="bg-transparent outline-none focus:outline-none w-0 absolute -z-50 opacity-0 overflow-hidden" />
                                                        </div>
                                                        <button id="answer_submit_btn"
                                                            class="btn-primary">{{ __('Send Reply') }}</button>
                                                    </div>

                                                </div>
                                                <p class="text-red-500 error:block hidden"></p>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div id="answers_container">
                            </div>

                            @include('forum::frontend.forum.components.ans_loader')

                            <!-- column-start -->
                        </div>

                        <div class="flex items-center justify-center hidden mt-30" id="load-more-button-area">
                            <button id="load-more-button" data-next_page_url=""
                                class="btn-primary bg-headline border-headline font-medium">
                                {{ __('Load more Answers') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-3">
                    <div class="p-30 shadow-common bg-opacity rounded-xl">
                        <div class="forum-sidepost mb-5 pb-5 border-b border-b-border">
                            <h5 class="mb-5">{{ __('Post by') }}</h5>
                            <div class="flex flex-col gap-4">
                                <div class="author-img size-[105px] rounded-full">
                                    <img src="{{ asset($post->user->image ?? $general_setting->default_avatar) }}"
                                        alt="instructor-img" class="h-full w-full" />
                                </div>
                                <div>
                                    <h4>{{ $post->user->name }}</h4>
                                    <p class="text-primary">{{ $post->user->designation }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-post">
                            <h5 class="mb-5">{{ __('Tags') }} ({{ $post->tags->count() }})</h5>
                            <div class="flex flex-wrap items-center gap-2">
                                @foreach ($post->tags as $tag)
                                    <a href="#"
                                        class="text-14 p-3 py-1 bg-border rounded-[100px] text-primary hover:bg-primary hover:text-white transition-all duration-300">{{ $tag->translate->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- instructor-details-end -->
@endsection

@push('js_section')
    <script>
        "use strict";

        let search_params = {
            search: null,
            from_search: false,
        }

        $(function() {



            $(document).on('click', '#reset-search-button', function(e) {
                e.preventDefault();
                search_params = {
                    ...search_params,
                    search: null,
                    from_search: false,
                };
                load_answers_with_ajax();
            });
        });


        async function get_query_params() {
            const urlParams = new URLSearchParams(window.location.search);
            search_params.category_id = urlParams.get('category_id');
            // search_params.from_search = true;

            // Wait for next event loop tick to ensure all params are set, then call AJAX
            await new Promise(resolve => setTimeout(resolve, 0));
            load_answers_with_ajax();
        }

        get_query_params();


        function load_answers_with_ajax(next_page_url = null) {

            let url = "{{ route('frontend.forum.show', $post->slug) }}";
            // url = url + '?ajax=true';

            if (next_page_url) {
                url = next_page_url;
            }


            $.ajax({
                type: 'GET',
                url: url,
                data: search_params,
                success: function(response) {
                    console.log(response);

                    if (next_page_url) {
                        $('#answers_container').append(response.html);
                        $("#answers_container").removeClass('hidden');
                        $("#load-more-button").html(`<span>{{ __('Load more Answers') }}</span>`);
                        $("#load-more-button").prop('disabled', false);
                        $("#load-more-button").attr('data-next_page_url', response.next_page_url);
                    } else {
                        $('#answers_container').html(response.html);
                        $("#answers_container").removeClass('hidden');
                        $("#load-more-button").html(`<span>{{ __('Load more Answers') }}</span>`);
                        $("#load-more-button").prop('disabled', false);
                    }

                    $("#answers_loader_container").addClass('hidden');

                    if (response.has_pagination) {
                        $("#load-more-button-area").removeClass('hidden');
                        $("#load-more-button").attr('data-next_page_url', response.next_page_url);
                    } else {
                        $("#load-more-button-area").addClass('hidden');
                        $("#load-more-button").attr('data-next_page_url', null);
                    }

                    if (response.next_page_url == null) {
                        $("#load-more-button-area").addClass('hidden');
                        $("#load-more-button").attr('data-next_page_url', null);
                    }

                    if (response.no_data_found) {
                        $("#no-data-found-area").removeClass('hidden');
                    } else {
                        $("#no-data-found-area").addClass('hidden');
                    }
                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 403) {
                        toastr.error(err.responseJSON.message);
                    } else {
                        toastr.error(
                            `{{ __('We are facing some technical issues. Please try again later.') }}`
                        )
                    }
                }
            });
        }

        $(document).on('click', '#load-more-button', function(e) {
            e.preventDefault();
            let loading_text = `<span>{{ __('Loading...') }}</span>`;
            $(this).html(`<span>${loading_text}</span>`);
            $(this).prop('disabled', true);
            var next_page_url = $(this).attr('data-next_page_url');
            if (next_page_url) {
                load_answers_with_ajax(next_page_url);
            }

        });
    </script>

    {{-- <script>
        $(document).on('click', '.forum-like-button, .forum-dislike-button, .answer-forum-dislike-button, .answer-forum-like-button', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let model_type = $btn.data('model_type');
            let post_id = $btn.data('post_id');
            let type = parseInt($btn.data('type'));

            let $container = $btn.closest('.forum-like-dislike-container');
            let $likeCount = $container.find('.like-count');
            let $dislikeCount = $container.find('.dislike-count');

            let user_reaction = $btn.attr('data-user_reaction');
            let original_user_reaction = $btn.attr('data-original_user_reaction');

            if (user_reaction === "null" || user_reaction === "" || user_reaction === undefined) {
                user_reaction = null;
            } else {
                user_reaction = parseInt(user_reaction);
            }

            // Read counts from attributes with a safe fallback
            let like_count = parseInt($likeCount.attr('data-like_count') || $likeCount.data('like_count') || 0);
            let dislike_count = parseInt($dislikeCount.attr('data-dislike_count') || $dislikeCount.data('dislike_count') || 0);

            // save originals and original user reaction for rollback on error
            $btn.data('original_like_count', like_count);
            $btn.data('original_dislike_count', dislike_count);
            $btn.data('original_user_reaction', user_reaction);

            // disable the clicked button(s) and enable the opposite within this container
            if (type === 1) {
                // clicked LIKE: disable like buttons, enable dislike buttons
                $container.find('.forum-like-button, .answer-forum-like-button').prop('disabled', true).addClass('clicked');
                $container.find('.forum-dislike-button, .answer-forum-dislike-button').prop('disabled', false).removeClass('clicked');
            } else {
                // clicked DISLIKE: disable dislike buttons, enable like buttons
                $container.find('.forum-dislike-button, .answer-forum-dislike-button').prop('disabled', true).addClass('clicked');
                $container.find('.forum-like-button, .answer-forum-like-button').prop('disabled', false).removeClass('clicked');
            }

            // remove previous highlight
            $container.find('.forum-like-icon').removeClass('text-primary');
            $container.find('.forum-dislike-icon').removeClass('text-primary');

            if (user_reaction === null) {
                if (type === 1) {
                    $likeCount.text(like_count + 1);
                    $likeCount.attr('data-like_count', like_count + 1);
                    $container.find('.forum-like-icon').addClass('text-primary');
                } else {
                    $dislikeCount.text(dislike_count + 1);
                    $dislikeCount.attr('data-dislike_count', dislike_count + 1);
                    $container.find('.forum-dislike-icon').addClass('text-primary');
                }

                // update reaction attribute for all buttons for this post
                $('[data-post_id="'+post_id+'"]').attr('data-user_reaction', type);

                forum_like_dislike(post_id, type, $btn, model_type);
                return;
            }

            if (user_reaction === 1) {
                $likeCount.text(like_count - 1);
                $likeCount.attr('data-like_count', like_count - 1);
                like_count--;
            }
            else if (user_reaction === 0) {
                $dislikeCount.text(dislike_count - 1);
                $dislikeCount.attr('data-dislike_count', dislike_count - 1);
                dislike_count--;
            }

            // Add new reaction
            if (type === 1) {
                $likeCount.text(like_count + 1);
                $likeCount.attr('data-like_count', like_count + 1);
                $container.find('.forum-like-icon').addClass('text-primary');

            } else {
                $dislikeCount.text(dislike_count + 1);
                $dislikeCount.attr('data-dislike_count', dislike_count + 1);
                $container.find('.forum-dislike-icon').addClass('text-primary');
            }

            // update data-user_reaction for next click
            $('[data-post_id="'+post_id+'"]').attr('data-user_reaction', type);

            forum_like_dislike(post_id, type, $btn, model_type);
        });

        function forum_like_dislike(post_id, type, $clickedBtn, model_type=null) {
            let url = "{{ route('user.forum.like-dislike', ':post_id') }}";
            url = url.replace(':post_id', post_id);
            let $likeDislikeContainer = $clickedBtn.closest('.forum-like-dislike-container');
            // ensure model_type is set (fallback to data attribute if not provided)
            if(!model_type){
                model_type = $clickedBtn.data('model_type') || null;
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,
                    post_id: post_id,
                    model_type: model_type
                },
                success: function(response) {
                    if(response.status === 'success'){
                        console.log('Like/Dislike updated successfully');
                        // update counts scoped to this container
                        $likeDislikeContainer.find('.like-count').text(response.like_count);
                        $likeDislikeContainer.find('.dislike-count').text(response.dislike_count);
                        $likeDislikeContainer.find('.like-count').attr('data-like_count', response.like_count);
                        $likeDislikeContainer.find('.dislike-count').attr('data-dislike_count', response.dislike_count);

                        // set disabled/clicked states according to selected type: keep clicked disabled
                        if (type === 1) {
                            $likeDislikeContainer.find('.forum-like-button, .answer-forum-like-button').addClass('clicked').prop('disabled', true);
                            $likeDislikeContainer.find('.forum-dislike-button, .answer-forum-dislike-button').removeClass('clicked').prop('disabled', false);
                        } else {
                            $likeDislikeContainer.find('.forum-dislike-button, .answer-forum-dislike-button').addClass('clicked').prop('disabled', true);
                            $likeDislikeContainer.find('.forum-like-button, .answer-forum-like-button').removeClass('clicked').prop('disabled', false);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON);

                    // restore original counts stored on the clicked button
                    let original_like_count = $clickedBtn.data('original_like_count');
                    let original_dislike_count = $clickedBtn.data('original_dislike_count');
                    let original_user_reaction = $clickedBtn.data('original_user_reaction');
                    let post_id = $clickedBtn.data('post_id');

                    original_like_count = (typeof original_like_count !== 'undefined') ? original_like_count : 0;
                    original_dislike_count = (typeof original_dislike_count !== 'undefined') ? original_dislike_count : 0;

                    // restore data-user_reaction attribute on all buttons for this post
                    $('[data-post_id="'+post_id+'"]').attr('data-user_reaction', original_user_reaction);

                    $likeDislikeContainer.find('.like-count').text(original_like_count);
                    $likeDislikeContainer.find('.like-count').attr('data-like_count', original_like_count);
                    $likeDislikeContainer.find('.dislike-count').text(original_dislike_count);
                    $likeDislikeContainer.find('.dislike-count').attr('data-dislike_count', original_dislike_count);

                    // remove highlights
                    $likeDislikeContainer.find('.forum-like-icon').removeClass('text-primary');
                    $likeDislikeContainer.find('.forum-dislike-icon').removeClass('text-primary');

                    // restore disabled/clicked states according to original user reaction
                    let orig_reaction = $clickedBtn.data('original_user_reaction');
                    if (orig_reaction === 1) {
                        $likeDislikeContainer.find('.forum-like-button, .answer-forum-like-button').addClass('clicked').prop('disabled', true);
                        $likeDislikeContainer.find('.forum-dislike-button, .answer-forum-dislike-button').removeClass('clicked').prop('disabled', false);
                        $likeDislikeContainer.find('.forum-like-icon').addClass('text-primary');
                        $likeDislikeContainer.find('.forum-dislike-icon').removeClass('text-primary');
                    } else if (orig_reaction === 0) {
                        $likeDislikeContainer.find('.forum-dislike-button, .answer-forum-dislike-button').addClass('clicked').prop('disabled', true);
                        $likeDislikeContainer.find('.forum-like-button, .answer-forum-like-button').removeClass('clicked').prop('disabled', false);
                        $likeDislikeContainer.find('.forum-dislike-icon').addClass('text-primary');
                        $likeDislikeContainer.find('.forum-like-icon').removeClass('text-primary');
                    } else {
                        // no prior reaction: enable both and clear clicked
                        $likeDislikeContainer.find('.forum-like-button, .forum-dislike-button, .answer-forum-like-button, .answer-forum-dislike-button').prop('disabled', false).removeClass('clicked');
                        $likeDislikeContainer.find('.forum-like-icon, .forum-dislike-icon').removeClass('text-primary');
                    }

                    if (xhr.status === 401 || xhr.status === 403) {
                        toastr.error(xhr.responseJSON ? xhr.responseJSON.message : 'Not authorized!');
                    } else {
                        toastr.error(`{{ __('Something went wrong. Please try again later.') }}`);
                    }
                }
            });
        }
    </script> --}}

    <script>
        $(document).on('click', `.forum-like-button,.forum-dislike-button,.answer-forum-like-button, .answer-forum-dislike-button`, function(e) {
            e.preventDefault();

            let $btn = $(this);
            let model_type = $btn.data('model_type');
            let post_id = $btn.data('post_id');
            let type = Number($btn.data('type'));

            let $container = $btn.closest('.forum-like-dislike-container');
            let $likeCount = $container.find('.like-count');
            let $dislikeCount = $container.find('.dislike-count');

            let user_reaction = $btn.attr('data-user_reaction');
            user_reaction = (user_reaction === "null" || user_reaction === "" || user_reaction === undefined) ?
                null :
                Number(user_reaction);

            // counts
            let like_count = Number($likeCount.attr('data-like_count') || 0);
            let dislike_count = Number($dislikeCount.attr('data-dislike_count') || 0);

            // store original values for rollback
            $btn.data({
                original_like_count: like_count,
                original_dislike_count: dislike_count,
                original_user_reaction: user_reaction
            });

            // helper: toggle button states (like/dislike)
            const toggleButtons = (reactionType) => {
                let likeBtns = $container.find('.forum-like-button, .answer-forum-like-button');
                let dislikeBtns = $container.find('.forum-dislike-button, .answer-forum-dislike-button');

                likeBtns.prop('disabled', reactionType === 1).toggleClass('clicked', reactionType === 1);
                dislikeBtns.prop('disabled', reactionType === 0).toggleClass('clicked', reactionType === 0);

                $container.find('.forum-like-icon').toggleClass('text-primary', reactionType === 1);
                $container.find('.forum-dislike-icon').toggleClass('text-primary', reactionType === 0);
            };

            // reaction apply
            const applyReaction = () => {
                if (user_reaction === type) return;

                if (user_reaction === 1) like_count--;
                if (user_reaction === 0) dislike_count--;

                if (type === 1) like_count++;
                else dislike_count++;

                $likeCount.text(like_count).attr('data-like_count', like_count);
                $dislikeCount.text(dislike_count).attr('data-dislike_count', dislike_count);

                toggleButtons(type);

                // update all buttons for that post
                $(`[data-post_id="${post_id}"]`).attr('data-user_reaction', type);
            };

            applyReaction();
            forum_like_dislike(post_id, type, $btn, model_type);
        });


        function forum_like_dislike(post_id, type, $clickedBtn, model_type = null) {

            let url = "{{ route('user.forum.like-dislike', ':post_id') }}".replace(':post_id', post_id);
            let $container = $clickedBtn.closest('.forum-like-dislike-container');
            if (!model_type) model_type = $clickedBtn.data('model_type') || null;

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    type,
                    post_id,
                    model_type
                },
                success: function(response) {
                    if (response.status !== "success") return;

                    $container.find('.like-count').text(response.like_count).attr('data-like_count', response
                        .like_count);
                    $container.find('.dislike-count').text(response.dislike_count).attr('data-dislike_count',
                        response.dislike_count);
                },

                error: function(xhr) {
                    let orig_like = $clickedBtn.data('original_like_count') || 0;
                    let orig_dislike = $clickedBtn.data('original_dislike_count') || 0;
                    let orig_reaction = $clickedBtn.data('original_user_reaction');
                    let post_id = $clickedBtn.data('post_id');

                    // restore everything
                    $container.find('.like-count').text(orig_like).attr('data-like_count', orig_like);
                    $container.find('.dislike-count').text(orig_dislike).attr('data-dislike_count',
                        orig_dislike);

                    // restore reaction
                    $(`[data-post_id="${post_id}"]`).attr('data-user_reaction', orig_reaction);

                    // restore UI
                    let likeBtns = $container.find('.forum-like-button, .answer-forum-like-button');
                    let dislikeBtns = $container.find('.forum-dislike-button, .answer-forum-dislike-button');

                    likeBtns.prop('disabled', orig_reaction === 1).toggleClass('clicked', orig_reaction === 1);
                    dislikeBtns.prop('disabled', orig_reaction === 0).toggleClass('clicked', orig_reaction ===
                        0);

                    $container.find('.forum-like-icon').toggleClass('text-primary', orig_reaction === 1);
                    $container.find('.forum-dislike-icon').toggleClass('text-primary', orig_reaction === 0);

                    // error message
                    if (xhr.status === 401 || xhr.status === 403)
                        toastr.error(xhr.responseJSON?.message ?? 'Not authorized!');
                    else
                        toastr.error(`{{ __('Something went wrong. Please try again later.') }}`);
                }
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            let is_form_submit = false;
            $('#answer_form').submit(function(e) {
                e.preventDefault();
                if (is_form_submit) return;

                const $form = $(this);
                const formData = new FormData(this);

                let buttonText = $("#answer_submit_btn").html();
                $("#answer_submit_btn").addClass('disabled opacity-50 cursor-not-allowed');
                $("#answer_submit_btn").text(`{{ __('Sending...') }}`);

                let url = "{{ route('user.forum.answer.store', ':post_id') }}";
                url = url.replace(':post_id', {{ $post->id }});
                is_form_submit = true;
                // console.log(Array.from(formData));
                // return;
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        toastr.success(response.message);
                        $("#answer_submit_btn").removeClass(
                            'disabled opacity-50 cursor-not-allowed');
                        $("#answer_submit_btn").html(buttonText);
                        $form[0].reset();
                        $("#body").val('');
                        $("#ImageList").empty();
                        is_form_submit = false;
                    },
                    error: function(err) {
                        formValidationHandler($form, err);
                        $("#answer_submit_btn").removeClass(
                            'disabled opacity-50 cursor-not-allowed');
                        $("#answer_submit_btn").html(buttonText);
                        is_form_submit = false;
                    }
                });
            });
        });
    </script>
@endpush
