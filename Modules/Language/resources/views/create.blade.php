@extends('admin.layout.master')
@section('title', 'Create Language')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Language</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('language.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Language Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Language Code</label>
                                <input type="text" class="form-control" name="lang_code" value="{{ old('lang_code') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option value="active">{{ __('Active') }}</option>
                                    <option value="inactive">{{ __('Inactive') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Direction</label>
                                <select class="form-control" name="language_direction">
                                    <option value="">Select Direction</option>
                                    <option value="left_to_right">{{ __('Left to Right') }}</option>
                                    <option value="right_to_left">{{ __('Right to Left') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Make Default</label>
                                <select class="form-control" name="is_default">
                                    <option value="">Select Status</option>
                                    <option value="1">{{ __('Default') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Add Language</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
