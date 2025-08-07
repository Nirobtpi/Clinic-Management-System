@extends('admin.layout.master')
@section('title', 'Create Doctor')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Appointment</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Doctor Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Birth Day Date</label>
                                <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control" name="image">
                                <img id="blah" src="" alt="" class="mt-2" width="60">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Departments</label>
                                <select class="form-control" name="department_id">
                                    <option>-- Select --</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <div class="status-toggle">
                                    <input type="checkbox" id="status_2" name="status" class="check">
                                    <label for="status_2" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Add Doctor</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
