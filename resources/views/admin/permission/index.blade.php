@extends('admin.layout.master')
@section('title', 'Role List')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="row">
                @can('super-admin')
                    <div class="col-sm-12 col px-5">
                        <a href="{{ route('permission.add') }}"
                            class="btn btn-primary float-right mt-2">Add</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Permission Name</th>
                                <th>Created At</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($permission->name) }}</td>
                                <td>{{ $permission->created_at->format('d M Y') }}</td>

                                <td class="text-right">
                                    <div class="actions d-flex justify-content-end gap-3">
                                        @can('super-admin')
                                        <a class="btn btn-sm bg-success-light mr-3"
                                            href="{{ route('permission.edit', $permission->id) }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('permission.delete', $permission->id) }}" id="delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm bg-danger-light delete-btn">
                                            <i class="fe fe-trash"></i> Delete
                                        </button>
                                        </form>
                                        @endcan
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
