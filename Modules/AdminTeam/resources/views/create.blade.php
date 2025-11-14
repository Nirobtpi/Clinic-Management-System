@extends('admin.layout.master')
@section('title', 'Add Role')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="row">
                <div class="col-sm-12 col px-5">
                    <a href="{{ route('adminteam.role.list') }}"
                        class="btn btn-primary float-right mt-2">Role List</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('adminteam.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Display Name <span class="text-danger">*</span></label>
                        <input type="text" name="display_name" class="form-control @error('display_name') is-invalid @enderror"
                            value="{{ old('display_name') }}">
                        @error('display_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description </label>
                       <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div>
                        <div id="accessPermission" class="mt-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">{{ __('Access Permissions') }}</h5>
                                        <div class="form-check">
                                            <input type="checkbox"
                                                id="masterCheckbox"
                                                class="form-check-input">
                                            <label for="masterCheckbox" class="form-check-label fw-bold">
                                                {{ __('Select All Permissions') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0" id="permissionGroups">
                                        @foreach ($permissions as $group)
                                        <li class="border rounded mb-3">
                                            <!-- Permission Group Header -->
                                            <div class="bg-light p-3 border-bottom">
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        id="groupCheckbox{{ $group->id }}"
                                                        name="permissions[groups][]"
                                                        value="{{ $group->id }}"
                                                        class="form-check-input group-checkbox"
                                                        data-group="{{ $group->id }}">
                                                    <label for="groupCheckbox{{ $group->id }}" class="form-check-label fw-bold">
                                                        {{ $group->display_name }}
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Permission Group Children -->
                                            <div class="p-3">
                                                <div class="row">
                                                    @foreach ($group->children as $child)
                                                    <div class="col-md-3 col-sm-6 mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"
                                                                id="childCheckbox{{ $child->id }}"
                                                                name="permissions[children][]"
                                                                value="{{ $child->id }}"
                                                                class="form-check-input child-checkbox"
                                                                data-group="{{ $group->id }}">
                                                            <label for="childCheckbox{{ $child->id }}" class="form-check-label">
                                                                {{ $child->display_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Role</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
        $(document).ready(function() {

            // Group parent click: check/uncheck all children
            $('.group-checkbox').on('change', function() {
                var groupId = $(this).data('group');
                var checked = $(this).is(':checked');
                $('.child-checkbox[data-group="' + groupId + '"]').prop('checked', checked).trigger('change');
            });

            // Child click: if all children checked, check parent; else uncheck parent
            $('.child-checkbox').on('change', function() {
                var groupId = $(this).data('group');
                var $children = $('.child-checkbox[data-group="' + groupId + '"]');
                var $parent = $('.group-checkbox[data-group="' + groupId + '"]');

                if ($children.length === $children.filter(':checked').length) {
                    $parent.prop('checked', true);
                } else {
                    $parent.prop('checked', false);
                }
                updateMasterCheckbox();
            });

            // Master checkbox: check/uncheck all groups and children
            $('#masterCheckbox').on('change',function(){
                var checked = $(this).is(':checked');
                $('.group-checkbox, .child-checkbox').prop('checked', checked).trigger('change');
            })

            // Update master checkbox based on all group/child checkboxes
            function updateMasterCheckbox() {
                var all = $('.group-checkbox, .child-checkbox');
                var checked = all.length === all.filter(':checked').length;
                $('#masterCheckbox').prop('checked', checked);
            }

            // When group checkbox changes, update master
            $('.group-checkbox').on('change', function() {
                updateMasterCheckbox();
            });

            // On page load, sync parent/child/master states
            $('.group-checkbox').each(function() {
                var groupId = $(this).data('group');
                var $children = $('.child-checkbox[data-group="' + groupId + '"]');
                if ($children.length && $children.length === $children.filter(':checked').length) {
                    $(this).prop('checked', true);
                }
            });
            updateMasterCheckbox();
        });
    </script>

@endpush
