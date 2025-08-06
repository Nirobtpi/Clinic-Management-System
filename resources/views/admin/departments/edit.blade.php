@extends('admin.layout.master')
@section('title', 'Edit Department')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Department</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $department->name }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="image">
                                <img id="blah" src="{{ asset($department->logo) }}" alt="" class="mt-2" width="60">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ $department->description }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <div class="status-toggle">
                                    <input type="checkbox" id="status_2" name="status" {{ $department->status == "on" ? "checked" : "" }} class="check">
                                    <label for="status_2" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
