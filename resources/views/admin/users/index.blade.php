@extends('admin.layout.master')
@section('title', 'User List')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-12 col px-5">
                    <a href="{{ route('users.create') }}"
                        class="btn btn-primary float-right mt-2">Add</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="" class="avatar avatar-sm mr-2"><img
                                                class="avatar-img rounded-circle"
                                                src="{{ asset($user->photo) }}" alt="User Image"></a>
                                        <a href="">{{ $user->name }}</a>
                                    </h2>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{Carbon\Carbon::parse($user->birthday)->age }} Years</td>
                                <td>{{ $user->address_line_one }}</td>

                                <td>
                                        <div class="status-toggle">
                                            <input type="checkbox" data-url="{{ route('user.status', $user->id) }}" id="status_update{{ $user->id }}" class="check status_update" {{ $user->status == 'active' ? 'checked' : '' }}>
                                            <label for="status_update{{ $user->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                </td>
                                <td class="text-right">
                                    <div class="actions d-flex justify-content-end gap-3">
                                        <a class="btn btn-sm bg-success-light mr-3"
                                            href="{{ route('users.edit', $user->id) }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" id="delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm bg-danger-light delete-btn">
                                            <i class="fe fe-trash"></i> Delete
                                        </button>
                                        </form>
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
