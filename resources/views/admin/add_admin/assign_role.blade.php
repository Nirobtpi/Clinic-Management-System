@extends('admin.layout.master')
@section('title', 'Add New Role')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Add Admin Team') }}</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('team.role.store', $admin->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('User Name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}">
                            </div>
                        </div>
                            <div class="col-md-12 mb-3">
                                <div class="checkbox">
                                    {{-- @foreach($roles as $role)
                                        <label class="mr-3"><input type="checkbox" @php
                                           in_array($role->id, $role_permissions) ? print("checked") : print("");
                                        @endphp  value="{{ $permission->id }}" name="permission[]"> {{ $permission->name }}</label>
                                    @endforeach --}}
                                    @foreach($roles as $role)
                                        <label class="mr-3"><input type="checkbox" @php
                                           in_array($role->id, $roles_id) ? print("checked") : print("");
                                        @endphp  value="{{ $role->id }}" name="role[]"> {{ $role->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('Update Role') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
