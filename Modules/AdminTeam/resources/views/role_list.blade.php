@extends('admin.layout.master')
@section('title', 'Role List')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            @can('super-admin')
            <div class="row">
                <div class="col-sm-12 col px-5">
                    <a href="{{ route('adminteam.create') }}"
                        class="btn btn-primary float-right mt-2">Add</a>
                </div>
            </div>
            @endcan
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Role Name</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $role->display_name }}
                                </td>
                                <td>
                                    {{ ucfirst($role->status) }}
                                </td>
                                <td class="text-right">
                                    <div class="actions d-flex justify-content-end gap-3">
                                            {{-- <a class="btn btn-sm bg-success-light mr-3"
                                                href="{{ route('adminteam.permission', $role->id) }}">
                                                <i class="fe fe-pencil"></i> Add Role
                                            </a> --}}
                                            @if($role->name != 'super_admin')
                                                <a class="btn btn-sm bg-success-light mr-3"
                                                    href="{{ route('adminteam.edit', $role->id) }}">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('adminteam.destroy', $role->id) }}" id="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm bg-danger-light delete-btn">
                                                    <i class="fe fe-trash"></i> Delete
                                                </button>
                                                </form>
                                            @else
                                                <span class="text-muted">Restricted</span>
                                            @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('.delete-btn').on('click', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
        $('.status_update').on('click', function () {
            var url = $(this).data('url');
            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    toastr.success(response.message);
                }
            })
        });
    });

</script>

@endpush
