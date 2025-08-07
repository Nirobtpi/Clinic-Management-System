@extends('admin.layout.master')
@section('title', 'Create User')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create User</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">User Name</label>
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
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Birth Day Date</label>
                                <input type="date" class="form-control" name="birth_date"
                                    value="{{ old('birth_date') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                    value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}">
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
                        <div class="col-12 col-md-12" >
                            <div class="form-group" >
                                <label>Blood Group</label>
                                <select class="form-control select select2-hidden-accessible" name="blood_group"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select Blood Group</option>
                                    <option value="a-">A-</option>
                                    <option value="a+">A+</option>
                                    <option value="b-">B-</option>
                                    <option value="b+">B+</option>
                                    <option value="ab-">AB-</option>
                                    <option value="ab+">AB+</option>
                                    <option value="o-">O-</option>
                                    <option value="o+">O+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" value="male" name="gender"> Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="female" name="gender"> Female
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="other" name="gender"> Other
                                </label>
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
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
