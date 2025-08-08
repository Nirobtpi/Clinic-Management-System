@extends('admin.layout.master')
@section('title', 'Country List')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-12 col px-5">
                    <a href="{{ route('countries.create') }}"
                        class="btn btn-primary float-right mt-2">Add</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>Country Name</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $country)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <p>{{ $country->name }}</p>
                                    </h2>
                                </td>
                                <td><p class="{{ $country->status == 'active' ? 'badge badge-success' : 'badge badge-danger' }}">{{ $country->status }}</p></td>
                                <td class="text-right">
                                    <div class="actions d-flex justify-content-end gap-3">
                                        <a class="btn btn-sm bg-success-light mr-3"
                                            href="{{ route('countries.edit', $country->id) }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('countries.destroy', $country->id) }}" id="delete-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-danger-light delete-btn">
                                                <i class="fe fe-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
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
    });

</script>

@endpush
