@extends('admin.layout.master')
@section('title', 'Edit Permission')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Edit Permission') }}</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('role.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Permission Name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $permission->name) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('Edit Permission') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
