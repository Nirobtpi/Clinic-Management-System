@extends('admin.layout.master')
@section('title', 'Edit')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Edit') }}</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('team.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Team Member Name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control" readonly value="{{ $admin->email }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Birth Day Date') }}</label>
                                <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $admin->birth_date) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control" name="photo">
                                <img id="blah" src="" alt="" class="mt-2" width="60">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Address') }}</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <div class="status-toggle">
                                    <input type="checkbox" value="1" id="status_2" name="status" class="check">
                                    <label for="status_2" class="checktoggle">{{ __('checkbox') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('Add Team Member') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
