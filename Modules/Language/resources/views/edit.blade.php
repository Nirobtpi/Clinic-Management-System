@extends('admin.layout.master')
@section('title', 'Edit Language')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Language</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('language.update', $language->id) }}" method="POST" enctype="multipart/form-data" id="edit_language_form" data-id="{{ $language->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Language Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $language->name ?? old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Language Code</label>
                                <input type="text" class="form-control" readonly value="{{ $language->code ?? old('lang_code') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option @selected($language->status == 'active') value="active">{{ __('Active') }}</option>
                                    <option @selected($language->status == 'inactive') value="inactive">{{ __('Inactive') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Direction</label>
                                <select class="form-control" name="language_direction">
                                    <option value="">Select Direction</option>
                                    <option @selected($language->language_direction == 'left_to_right') value="left_to_right">{{ __('Left to Right') }}</option>
                                    <option @selected($language->language_direction == 'right_to_left') value="right_to_left">{{ __('Right to Left') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Make Default</label>
                                <select class="form-control" name="is_default">
                                    <option value="">Select Status</option>
                                    <option @selected($language->default == 1) value="1">{{ __('Default') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Edit Language</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
