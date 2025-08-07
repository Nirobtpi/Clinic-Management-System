@extends('admin.layout.master')
@section('title', 'Edit User')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit User</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Birth Day Date</label>
                                <input type="date" class="form-control" name="birth_date"
                                    value="{{ old('birth_date', $user->birthday) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control" name="photo">
                                <img id="blah" src="{{ asset($user->photo) }}" alt="" class="mt-2" width="60">
                            </div>
                        </div>
                        <div class="col-12 col-md-12" >
                            <div class="form-group" >
                                <label>Blood Group</label>
                                <select class="form-control select select2-hidden-accessible" name="blood_group"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select Blood Group</option>
                                    <option @selected($user->blood_group == 'a-') value="a-">A-</option>
                                    <option @selected($user->blood_group == 'a+') value="a+">A+</option>
                                    <option @selected($user->blood_group == 'b-') value="b-">B-</option>
                                    <option @selected($user->blood_group == 'b+') value="b+">B+</option>
                                    <option @selected($user->blood_group == 'ab-') value="ab-">AB-</option>
                                    <option @selected($user->blood_group == 'ab+') value="ab+">AB+</option>
                                    <option @selected($user->blood_group == 'o-') value="o-">O-</option>
                                    <option @selected($user->blood_group == 'o+') value="o+">O+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address', $user->address_line_one) }}">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" value="male" @if ($user->gender == 'male') checked @endif
                                     name="gender"> Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" @if ($user->gender == 'female') checked @endif value="female" name="gender"> Female
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" @if ($user->gender == 'other') checked @endif value="other" name="gender"> Other
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <div class="status-toggle">
                                    <input type="checkbox" id="status_2" name="status" class="check" @if ($user->status == 'active') checked @endif>
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
