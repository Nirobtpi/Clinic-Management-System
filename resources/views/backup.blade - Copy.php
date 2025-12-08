@extends('layout')
@section('title')
    <title>{{ $seo_setting?->seo_title }}</title>
    <meta name="title" content="{{ $seo_setting?->seo_title }}">
    <meta name="description" content="{!! strip_tags(clean($seo_setting?->seo_description)) !!}">
@endsection

@section('body-content')
        <!-- breadcrumb-starts -->
        <section class="breadcrumb relative bg-primary">
            <div class="container">
                <div class="pt-[124px] pb-14 text-center">
                    <h2 class="text-white">Forum Process</h2>
                </div>
            </div>
        </section>

        <!-- forum-starts -->
        <section class="py-100">
            <div class="container">
                <div class="grid xl:grid-cols-12 gap-[50px]">
                    <div class="xl:col-span-9">
                        <div>
                            <div class="flex items-center justify-between mb-30">
                                <h4><span id="discussion-count">0</span> {{__('Discussions')}}</h4>
                                <button class="btn-primary" onclick='initModal("create-modal").showModal()'>
                                    {{ __('Ask a New Question') }}
                                </button>
                            </div>
                            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-5 mb-6">
                                <div
                                    class="flex items-center gap-2 bg-opacity max-w-[552px] w-full border border-border rounded-md p-3.5 py-3 focus-within:border-primary transition-all duration-300">
                                    <input type="text" id="search_keyword" name="search"
                                        class="text-14 bg-transparent w-full border-none focus-within:outline-none"
                                        placeholder="Search keyword..." value="{{ request('search') }}" />
                                    <span class="cursor-pointer" id="search-btn">
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.3482 15.1295L12.2172 11.0646C13.299 9.8893 13.9637 8.33495 13.9637 6.62455C13.9632 2.96568 10.9495 0 7.23158 0C3.5137 0 0.5 2.96568 0.5 6.62455C0.5 10.2834 3.5137 13.2491 7.23158 13.2491C8.83796 13.2491 10.3113 12.6935 11.4686 11.7697L15.6155 15.8507C15.8176 16.0498 16.1457 16.0498 16.3477 15.8507C16.5502 15.6517 16.5502 15.3286 16.3482 15.1295ZM7.23158 12.2299C4.08585 12.2299 1.53575 9.72029 1.53575 6.62455C1.53575 3.52881 4.08585 1.01923 7.23158 1.01923C10.3773 1.01923 12.9274 3.52881 12.9274 6.62455C12.9274 9.72029 10.3773 12.2299 7.23158 12.2299Z"
                                                fill="#686E7D"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="grid gap-6 relative" id="forum-posts-container">

                            </div>

                            @include('forum::frontend.forum.components.loader')

                            <div class="flex items-ceneter justify-center mt-10 hidden" id="no-data-found-area">
                                <div class="!max-w-[616px] flex flex-col items-center">
                                    <img src="{{ asset('uploads/website-images/no_data_found.png') }}" alt=""
                                        class="max-w-fit max-h-fit object-contain" />
                                    <h3 class="mt-10 mb-5 text-center">
                                        {{ __('Oops! We Couldn’t Find a Match') }}
                                    </h3>
                                    <p class="text-center text-18 mb-5">
                                        {{ __('It looks like there are no classrooms matching your selection right now. Try another keyword') }}
                                        <span class="text-headline">{{ __('Thank you') }}</span>
                                    </p>
                                    <a href="javascript:void(0)" id="reset-search-button"
                                        class="btn-primary">{{ __('Back to Home') }}</a>
                                </div>
                            </div>

                            <div class="flex items-center hidden justify-center mt-30" id="load-more-button-area">
                                <button class="btn-primary bg-headline border-headline font-medium" id="load-more-button" data-next_page_url="">
                                    {{ __('Load More') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="xl:col-span-3">
                        <div class="p-30 shadow-common bg-opacity rounded-xl">
                            <div class="forum-sidepost mb-5 pb-5 border-b border-b-border">
                                <div class="h-[235px] overflow-y-scroll fc-scroller">
                                    <div class="flex flex-col gap-4">
                                        @foreach ($forum_categories as $category)
                                        <div class="checkbox-item">
                                            <label class="text-14 text-headline flex items-center gap-2 cursor-pointer">
                                                <input class="ajax-search-category" type="checkbox" name="forum_category_id[]" value="{{ $category->id }}" />
                                                {{ $category->name }}
                                                <span class="text-paragraph">({{ $category->posts_count }})</span></label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-post">
                                <h5 class="mb-5">{{__('Tags')}} ({{ $forum_tags->count() }})</h5>
                                <div class="flex flex-wrap items-center gap-2">
                                    @foreach ($forum_tags as $tag)
                                    <a href="javascript:void(0)" data-tag_slug="{{ $tag->slug }}"
                                        class="text-14 p-3 py-1 tag_filter_button bg-border rounded-[100px] text-primary hover:bg-primary hover:text-white transition-all duration-300">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="create-modal"
            class="modal-overlay !hidden opacity-0 transition-opacity duration-300 w-screen h-screen bg-black/70 flex justify-center items-center fixed top-0 left-0 z-50">
            <div class="overflow-hidden w-full h-fit rounded-xl max-w-[755px]" onclick="event.stopPropagation()">
                <div class="modal-content w-full h-fit max-h-[90vh] bg-white p-5 sm:p-10 overflow-y-auto relative">
                    <!-- Close Button -->
                    <h4 class="mb-5">{{__('Create New Question')}}</h4>

                    <button
                        class="modal-close size-8 rounded-full bg-primary hover:bg-error text-white hover:text-white flex justify-center items-center absolute top-4 right-4 transition-all duration-300">
                        <!-- SVG icon -->
                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.1108 1L1.00177 12.1097" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" />
                            <path d="M12.1108 12.1094L1.00177 0.999716" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" />
                        </svg>
                    </button>

                    <form action="">
                        <div class="grid gap-4">
                            <!-- single input  -->
                            <div class="">
                                <label for="title" class="input-label"> Title </label>
                                <input type="text" id="title" name="title" class="input-filed bg-opacity"
                                    placeholder="Write a new Question title " />
                            </div>
                            <!-- column -starts -->
                            <div class="w-full filter-select-input tutor_language_id error_wrapper">
                                <label for="categoryInput" class="input-label">
                                    Choose Category
                                </label>
                                <div class="relative">
                                    <div class="flex gap-2">
                                        <div class="w-full relative">
                                            <div
                                                class="flex items-center relative border border-border rounded focus-within:border-primary">
                                                <!-- set id like "your chosen name +"Input"  -->
                                                <input id="categoryInput" type="text" placeholder="City/Town"
                                                    class="w-full rounded-md outline-none focus:outline-none px-3 py-[11px] bg-opacity"
                                                    autocomplete="new-country" />
                                                <svg class="absolute right-3" width="12" height="6"
                                                    viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11 1L6 5L0.999999 0.999999" stroke="#0A192F"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div id="category-suggestions"
                                                class="absolute w-full bg-white border border-stock rounded mt-1 hidden max-h-[200px] overflow-y-auto z-10 modal-content">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="selectedcategory" name="tutor-language" value="" />

                                <p class="text-12 pt-1 text-red hidden error:block">
                                    message will be shown here
                                </p>
                            </div>

                            <!-- single input  -->
                            <div class="">
                                <label for="detail" class="input-label">
                                    Write the details about problem
                                </label>
                                <textarea type="text" id="detail" name="detail" class="input-filed bg-opacity"
                                    placeholder="Write a new Question title " rows="4"></textarea>
                            </div>
                            <div class="">
                                <label for="questionTagInput" class="input-label">
                                    Write Tag
                                </label>
                                <div class="relative mt-2 error_wrapper">
                                    <div class="flex gap-2">
                                        <div class="relative">
                                            <input id="questionTagInput" type="text" placeholder="Type tag"
                                                class="input-filed bg-opacity" />
                                            <input type="hidden" id="selectedTag" name="tutor-language"
                                                value="" />
                                            <div id="questionTag-suggestions"
                                                class="absolute w-full bg-white border border-border rounded mt-1 hidden max-h-[200px] overflow-y-auto z-10">
                                            </div>
                                        </div>

                                        <button type="button" id="questionTagAddBtn"
                                            class="bg-opacity border border-primary rounded-md size-12 flex justify-center items-center text-primary cursor-pointer">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_841_63349)">
                                                    <path
                                                        d="M12 23.5C11.7021 23.5 11.4165 23.3817 11.2059 23.1711C10.9953 22.9605 10.877 22.6748 10.877 22.377V1.62305C10.877 1.3252 10.9953 1.03954 11.2059 0.828933C11.4165 0.618321 11.7021 0.5 12 0.5C12.2979 0.5 12.5835 0.618321 12.7941 0.828933C13.0047 1.03954 13.123 1.3252 13.123 1.62305V22.377C13.123 22.6748 13.0047 22.9605 12.7941 23.1711C12.5835 23.3817 12.2979 23.5 12 23.5Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M22.377 13.123H1.62305C1.3252 13.123 1.03954 13.0047 0.828933 12.7941C0.618321 12.5835 0.5 12.2979 0.5 12C0.5 11.7021 0.618321 11.4165 0.828933 11.2059C1.03954 10.9953 1.3252 10.877 1.62305 10.877H22.377C22.6748 10.877 22.9605 10.9953 23.1711 11.2059C23.3817 11.4165 23.5 11.7021 23.5 12C23.5 12.2979 23.3817 12.5835 23.1711 12.7941C22.9605 13.0047 22.6748 13.123 22.377 13.123Z"
                                                        fill="currentColor" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_841_63349">
                                                        <rect width="23" height="23" fill="white"
                                                            transform="translate(0.5 0.5)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <input value="" class="hidden" id="questionTagHiddenInput" />
                                <div id="questionTagList" class="flex flex-wrap gap-2 mt-4"></div>
                            </div>
                            <div>
                                <label for="upImage" class="input-label">
                                    Upload file and image
                                </label>
                                <div class="image-input-multi-wrapper grid sm:grid-cols-4 gap-3">
                                    <div
                                        class="image-input-multi w-full flex justify-center items-center relative size-40 bg-opacity rounded-lg">
                                        <label for="cover-image" class="flex flex-col items-center gap-2 cursor-pointer">
                                            <svg width="58" height="57" viewBox="0 0 58 57" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M42.4263 19.6727C41.6565 16.5953 39.8806 13.8634 37.3806 11.9107C34.8807 9.95795 31.8001 8.89638 28.6279 8.89453C25.4557 8.89269 22.3738 9.95068 19.8716 11.9005C17.3694 13.8503 15.5904 16.5802 14.817 19.6567C11.1686 19.9991 7.79246 21.7337 5.38967 24.5003C2.98689 27.2669 1.7422 30.8527 1.91415 34.513C2.0861 38.1733 3.66148 41.6267 6.31305 44.1558C8.96461 46.685 12.4886 48.0955 16.1529 48.0943H21.4966C21.9691 48.0943 22.4221 47.9067 22.7562 47.5726C23.0902 47.2386 23.2779 46.7855 23.2779 46.3131C23.2779 45.8407 23.0902 45.3876 22.7562 45.0535C22.4221 44.7195 21.9691 44.5318 21.4966 44.5318H16.1529C14.7494 44.5359 13.3588 44.2635 12.0606 43.7302C10.7624 43.1969 9.58188 42.4131 8.58656 41.4236C6.57641 39.4251 5.44249 36.71 5.43422 33.8755C5.42595 31.041 6.54402 28.3193 8.54247 26.3092C10.5409 24.299 13.256 23.1651 16.0905 23.1568C16.5476 23.1912 17.0011 23.0546 17.3632 22.7736C17.7252 22.4925 17.97 22.087 18.0499 21.6356C18.4126 19.0921 19.6808 16.7648 21.6215 15.0812C23.5623 13.3976 26.0453 12.4707 28.6145 12.4707C31.1838 12.4707 33.6668 13.3976 35.6075 15.0812C37.5482 16.7648 38.8164 19.0921 39.1791 21.6356C39.2723 22.0713 39.5138 22.4611 39.8623 22.7385C40.2109 23.0159 40.6449 23.1638 41.0904 23.1568C43.9249 23.1568 46.6433 24.2828 48.6476 26.2871C50.6519 28.2914 51.7779 31.0098 51.7779 33.8443C51.7779 36.6788 50.6519 39.3972 48.6476 41.4015C46.6433 43.4058 43.9249 44.5318 41.0904 44.5318H35.7466C35.2742 44.5318 34.8212 44.7195 34.4871 45.0535C34.1531 45.3876 33.9654 45.8407 33.9654 46.3131C33.9654 46.7855 34.1531 47.2386 34.4871 47.5726C34.8212 47.9067 35.2742 48.0943 35.7466 48.0943H41.0904C44.7279 48.0563 48.2132 46.6285 50.8319 44.1036C53.4507 41.5787 55.0047 38.1479 55.1755 34.5142C55.3463 30.8805 54.121 27.319 51.7506 24.5596C49.3802 21.8002 46.0442 20.0518 42.4263 19.6727Z"
                                                    fill="#411EE2" />
                                                <path
                                                    d="M36.2735 35.1027C36.6094 35.4272 37.0593 35.6067 37.5264 35.6027C37.9934 35.5986 38.4402 35.4113 38.7704 35.081C39.1007 34.7508 39.288 34.304 39.2921 33.837C39.2962 33.3699 39.1166 32.92 38.7921 32.584L29.8859 23.6778C29.5519 23.3438 29.0989 23.1562 28.6265 23.1562C28.1542 23.1562 27.7012 23.3438 27.3672 23.6778L18.461 32.584C18.1365 32.92 17.9569 33.3699 17.961 33.837C17.9651 34.304 18.1524 34.7508 18.4827 35.081C18.8129 35.4113 19.2597 35.5986 19.7267 35.6027C20.1937 35.6067 20.6437 35.4272 20.9796 35.1027L26.8453 29.2371V51.6559C26.8453 52.1283 27.033 52.5814 27.367 52.9154C27.7011 53.2495 28.1541 53.4371 28.6265 53.4371C29.099 53.4371 29.552 53.2495 29.8861 52.9154C30.2201 52.5814 30.4078 52.1283 30.4078 51.6559V29.2371L36.2735 35.1027Z"
                                                    fill="#411EE2" />
                                            </svg>
                                            <p>
                                                Select to <span class="text-primary">Upload</span>
                                            </p>
                                        </label>
                                        <input type="file" id="cover-image" multiple class="absolute hidden" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="flex items-center justify-end gap-5 mt-4 border-t border-border pt-2.5">
                        <button class="font-medium text-headline">Not Now</button>
                        <button class="btn-primary cursor-pointer"
                            onclick='initModal("create-modal").hideModal();initModal("success-modal").showModal()'>
                            Publish Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Success Modal -->
        <div id="success-modal"
            class="modal-overlay !hidden opacity-0 transition-opacity duration-300 w-screen h-screen bg-black/70 flex justify-center items-center fixed top-0 left-0 z-50">
            <div
                class="modal-content w-full max-w-[516px] h-fit max-h-[90vh] bg-white rounded-xl p-5 sm:p-10 overflow-y-auto relative">
                <!-- Close Button -->
                <button
                    class="modal-close size-8 rounded-full bg-primary hover:bg-error text-white hover:text-white flex justify-center items-center absolute top-4 right-4 transition-all duration-300">
                    <!-- SVG icon -->
                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.1108 1L1.00177 12.1097" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                        <path d="M12.1108 12.1094L1.00177 0.999716" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </button>

                <div class="w-[244px] mx-auto">
                    <img src="./assets/img/step-success.png" alt="" />
                </div>
                <h3 class="font-medium text-center mt-8">
                    Your instructor application has been submitted
                </h3>
                <p class="text-center pt-5">
                    Your application is currently under review. You will be notified via
                    email once it's approved.
                </p>

                <div class="btn-primary modal-ok mx-auto mt-5 cursor-pointer w-fit">
                    Back to Home
                </div>
            </div>
        </div>

@endsection



@push('js_section')
    <script>
        "use strict";

        let search_params = {
            category_id: [],
            search: null,
            tag_slug: [],
            from_search: false,
        }

        $(function() {

            // Correct event is 'change' not 'click' for checkboxes, also rebuild category_id from checked boxes
            $(document).on('change', '.ajax-search-category', function(e) {
                e.preventDefault();
                search_params.category_id = $('.ajax-search-category:checked').map(function() {
                    return $(this).val();
                }).get();
                search_params.from_search = true;
                console.log(search_params.category_id);
                load_forum_posts_with_ajax();
            });

            $(document).on('click', '.tag_filter_button', function(e) {
                e.preventDefault();
                var tag_slug = $(this).data('tag_slug');
                $(this).toggleClass('bg-primary text-white clicked');
                if ($(this).hasClass('clicked')) {
                    search_params.tag_slug.push(tag_slug);
                } else {
                    search_params.tag_slug = search_params.tag_slug.filter(tag => tag !== tag_slug);
                }
                search_params.from_search = true;
                load_forum_posts_with_ajax();
            });

            // Search input debounce
            let searchInputTimeout;
            $(document).on('input', '#search_keyword', function(e) {
                e.preventDefault();
                const $input = $(this);
                clearTimeout(searchInputTimeout);
                searchInputTimeout = setTimeout(function() {
                    search_params.search = $input.val();
                    search_params.from_search = true;
                    load_forum_posts_with_ajax();
                }, 500); // Debounce for 500ms to avoid too many API calls
            });



            $(document).on('click', '#reset-search-button', function(e) {
                e.preventDefault();
                search_params = {
                    ...search_params,
                    category_id: [],
                    search: null,
                    tag_slug: [],
                    from_search: false,
                };

                // reset country select
                var category_select = $(".ajax-search-category");
                category_select.prop('checked', false);
                category_select.trigger('change');

                var search_input = $("#search_keyword");
                search_input.val('');


                var tag_select = $(".tag_filter_button");
                tag_select.removeClass('bg-primary text-white clicked');
                search_params.tag_slug = [];

                load_forum_posts_with_ajax();
            });
        });


        async function get_query_params() {
            const urlParams = new URLSearchParams(window.location.search);
            search_params.category_id = urlParams.get('category_id');
            // search_params.from_search = true;

            // Wait for next event loop tick to ensure all params are set, then call AJAX
            await new Promise(resolve => setTimeout(resolve, 0));
            load_forum_posts_with_ajax();
        }

        get_query_params();


        function load_forum_posts_with_ajax(next_page_url = null) {

            let url = "{{ route('frontend.forum.index') }}";
            if (next_page_url) {
                url = next_page_url;
            }

            if (search_params.from_search && search_params.from_search == true) {
                console.log('here here');

                $("#forum-posts-loader").removeClass('hidden');
                $("#forum-posts-container").addClass('hidden');
                $("#load-more-button-area").removeClass('hidden');
                $("#load-more-button").attr('data-next_page_url', null);
            }

            $.ajax({
                type: 'GET',
                url: url,
                data: search_params,
                success: function(response) {
                    console.log(response);
                    $('#discussion-count').text(response.total);

                    if (next_page_url) {
                        $('#forum-posts-container').append(response.html);
                        $("#forum-posts-container").removeClass('hidden');
                        $("#load-more-button").html(`<span>{{ __('Load more') }}</span>`);
                        $("#load-more-button").prop('disabled', false);
                        $("#load-more-button").attr('data-next_page_url', response.next_page_url);
                    } else {
                        $('#forum-posts-container').html(response.html);
                        $("#forum-posts-container").removeClass('hidden');
                        $("#load-more-button").html(`<span>{{ __('Load more') }}</span>`);
                        $("#load-more-button").prop('disabled', false);
                    }

                    $("#forum-posts-loader").addClass('hidden');

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
                load_forum_posts_with_ajax(next_page_url);
            }

        });
    </script>

    <script>
        $(document).on('click', '.forum-like-button, .forum-dislike-button', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let model_type = $btn.data('model_type');
            let post_id = $btn.data('post_id');
            let type = parseInt($btn.data('type'));

            let $container = $btn.closest('.forum-like-dislike-container');
            let $likeCount = $container.find('.like-count');
            let $dislikeCount = $container.find('.dislike-count');

            let user_reaction = $btn.attr('data-user_reaction');

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
                $container.find('.forum-like-button').prop('disabled', true).addClass('clicked');
                $container.find('.forum-dislike-button').prop('disabled', false).removeClass('clicked');
            } else {
                // clicked DISLIKE: disable dislike buttons, enable like buttons
                $container.find('.forum-dislike-button').prop('disabled', true).addClass('clicked');
                $container.find('.forum-like-button').prop('disabled', false).removeClass('clicked');
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

                        if (type === 1) {
                            $likeDislikeContainer.find('.forum-like-button').addClass('clicked').prop('disabled', true);
                            $likeDislikeContainer.find('.forum-dislike-button').removeClass('clicked').prop('disabled', false);
                        } else {
                            $likeDislikeContainer.find('.forum-dislike-button').addClass('clicked').prop('disabled', true);
                            $likeDislikeContainer.find('.forum-like-button').removeClass('clicked').prop('disabled', false);
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
                        $likeDislikeContainer.find('.forum-like-button').addClass('clicked').prop('disabled', true);
                        $likeDislikeContainer.find('.forum-dislike-button').removeClass('clicked').prop('disabled', false);
                        $likeDislikeContainer.find('.forum-like-icon').addClass('text-primary');
                        $likeDislikeContainer.find('.forum-dislike-icon').removeClass('text-primary');
                    } else if (orig_reaction === 0) {
                        $likeDislikeContainer.find('.forum-dislike-button').addClass('clicked').prop('disabled', true);
                        $likeDislikeContainer.find('.forum-like-button').removeClass('clicked').prop('disabled', false);
                        $likeDislikeContainer.find('.forum-dislike-icon').addClass('text-primary');
                        $likeDislikeContainer.find('.forum-like-icon').removeClass('text-primary');
                    } else {
                        // no prior reaction: enable both and clear clicked
                        $likeDislikeContainer.find('.forum-like-button, .forum-dislike-button').prop('disabled', false).removeClass('clicked');
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
    </script>

   {{-- <script>
        $(document).on('click', '.forum-like-button, .forum-dislike-button', function(e) {
            e.preventDefault();
            let $btn = $(this);
            let model_type = $btn.data('model_type');
            let post_id = $btn.data('post_id');
            let type = $btn.data('type');
            let $container = $btn.closest('.forum-like-dislike-container');
            let $likeCount = $container.find('.like-count');
            let $dislikeCount = $container.find('.dislike-count');
            let like_count = parseInt($likeCount.data('like_count'));
            let dislike_count = parseInt($dislikeCount.data('dislike_count'));
            let user_reaction = $btn.data('user_reaction');

            $btn.prop('disabled', true);
            $btn.addClass('clicked');

            if ($btn.hasClass('clicked')) {
                $btn.prop('disabled', true);
            }
            if (user_reaction === null) {
                 if (type == 1) {
                    $container.find('.forum-like-icon').addClass('text-primary');
                    $likeCount.text(like_count + 1);
                    $likeCount.data('like_count', like_count + 1);
                } else if (type == 0) {
                    $container.find('.forum-dislike-icon').addClass('text-primary');
                    $dislikeCount.text(dislike_count + 1);
                    $dislikeCount.data('dislike_count', dislike_count + 1);
                 }

                forum_like_dislike(post_id, type, $btn, model_type);
                return;
            }


            // fallback: some buttons used `data-model` by mistake — read both
            if (!model_type) {
                model_type = $btn.data('model_type') || null;
                return;
            }

            // Store the current counts before optimistic update
            $btn.data('original_like_count', like_count);
            $btn.data('original_dislike_count', dislike_count);

            $container.find('.forum-like-icon').removeClass('text-primary');
            $container.find('.forum-dislike-icon').removeClass('text-primary');

            if (type == 1) {
                $container.find('.forum-like-icon').addClass('text-primary');
                $container.find('.forum-dislike-icon').removeClass('text-primary');
                $likeCount.text(like_count + 1);
                $likeCount.data('like_count', like_count + 1);
                if (dislike_count > 0) {
                    $dislikeCount.text(dislike_count - 1);
                    $dislikeCount.data('dislike_count', dislike_count - 1);
                }
            } else if (type == 0) {
                $container.find('.forum-dislike-icon').addClass('text-primary');
                $container.find('.forum-like-icon').removeClass('text-primary');
                $dislikeCount.text(dislike_count + 1);
                $dislikeCount.data('dislike_count', dislike_count + 1);
                if (like_count > 0) {
                    $likeCount.text(like_count - 1);
                    $likeCount.data('like_count', like_count - 1);
                }
            }

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
                        $likeDislikeContainer.find('.like-count').text(response.like_count);
                        $likeDislikeContainer.find('.dislike-count').text(response.dislike_count);

                        $likeDislikeContainer.find('.like-count').attr('data-like_count', response.like_count);
                        $likeDislikeContainer.find('.dislike-count').attr('data-dislike_count', response.dislike_count);
                    }
                },
               error: function(xhr, status, error) {
                    console.log(xhr.responseJSON);
                    $clickedBtn.prop('disabled', false);
                    $clickedBtn.removeClass('clicked');

                    let original_like_count = $clickedBtn.data('original_like_count');
                    let original_dislike_count = $clickedBtn.data('original_dislike_count');


                    $likeDislikeContainer.find('.like-count').text(original_like_count);
                    $likeDislikeContainer.find('.like-count').data('like_count', original_like_count);
                    $likeDislikeContainer.find('.dislike-count').text(original_dislike_count);
                    $likeDislikeContainer.find('.dislike-count').data('dislike_count', original_dislike_count);

                    if(type == 1){
                        console.log('like');
                        $likeDislikeContainer.find('.forum-like-icon').removeClass('text-primary');
                        $likeDislikeContainer.find('.forum-dislike-icon').removeClass('text-primary');
                    } else if(type == 0){
                        console.log('dislike');
                        $likeDislikeContainer.find('.forum-like-icon').removeClass('text-primary');
                        $likeDislikeContainer.find('.forum-dislike-icon').removeClass('text-primary');
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

@endpush

