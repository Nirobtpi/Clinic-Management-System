@extends('admin.layout.master')
@section('title', 'Edit Country')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Country</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('countries.update', $country->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Country Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $country->name) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <div class="status-toggle">
                                    <input type="checkbox" {{ $country->status == 'active' ? 'checked' : '' }} id="status_2" name="status" class="check">
                                    <label for="status_2" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Add Country</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
