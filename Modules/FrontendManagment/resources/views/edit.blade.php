@extends('admin.layout.master')
@section('title', 'Frontend Sections List')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $section['name'] ?? 'Section' }} - Edit</h5>
                    <form action="{{ route('frontendmanagment.update',['frontendmanagment' => $key,'id' => $frontend->id ?? null]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                        <input type="hidden" name="type" value="{{ $contentType }}">

                        <div class="row">
                            @if ($imageCount > 0)
                                <div class="col-4">
                                    @if ($content)
                                        @foreach ($content as $fieldKey => $field)
                                            @if ($fieldKey == 'images' and $imageCount > 0)
                                                @foreach ($field as $imageKey => $image)
                                                    @php
                                                        $imagePath = $data_values['images'][$imageKey] ?? null;
                                                    @endphp
                                                    <div class="form-group">
                                                        <label
                                                            for="{{ $imageKey }}">{{ ucfirst(str_replace('_', ' ', $imageKey)) }}</label>
                                                        <input type="file" class="form-control"
                                                            id="{{ $imageKey }}"
                                                            name="{{ $imageKey }}">
                                                        @if ($imagePath)
                                                            <div class="mt-2">
                                                                <img src="{{ asset($imagePath) }}"
                                                                    alt="{{ $imageKey }}"
                                                                    style="max-width: 100%; height: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                            <div class="{{ $imageCount > 0 ? 'col-8' : 'col-12' }}">
                                @if ($content)
                                    @foreach ($content as $fieldKey => $field)
                                        @if ($fieldKey != 'images')
                                            @if (is_array($field))
                                                @foreach ($field as $subField => $subValue)
                                                    <div class="form-group">
                                                        <label
                                                            for="{{ $fieldKey }}">{{ ucfirst(str_replace('_', ' ', $fieldKey)) }}
                                                            - {{ ucfirst(str_replace('_', ' ', $subField)) }}</label>
                                                        <input type="text" class="form-control" id="{{ $fieldKey }}"
                                                            name="{{ $fieldKey }}[{{ $subField }}]"
                                                            value="{{ $data_values[$fieldKey][$subField] ?? '' }}">
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="form-group @if (!$loop->first) mt-4 @endif">
                                                        <label for="{{ $fieldKey }}"
                                                            class="form-label">{{ str_replace('_', ' ', ucfirst($fieldKey)) }}

                                                            @php
                                                                $colorfull = trans(
                                                                    'For highlight title, write the title inside <span>highlight</span> tag',
                                                                );
                                                            @endphp

                                                            @if ($key == 'main_demo_hero' && $field == 'heading')
                                                                <code>({{ $colorfull }})</code>
                                                            @elseif (
                                                                ($key == 'home1_join_instructor' && $field == 'first_item_title') ||
                                                                    ($key == 'home1_join_instructor' && $field == 'second_item_title'))
                                                                <code>({{ $colorfull }})</code>
                                                            @elseif ($key == 'home4_hero' && $field == 'title')
                                                                <code>({{ $colorfull }})</code>
                                                            @endif

                                                        </label>
                                                        <input type="text" id="{{ $fieldKey }}"
                                                            name="{{ $fieldKey }}" class="form-control"
                                                            value="{{ $data_values[$fieldKey] ?? $field }}">
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
