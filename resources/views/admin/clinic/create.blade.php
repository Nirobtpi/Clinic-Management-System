@extends('admin.layout.master')
@section('title', 'Create Clinic')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Clinic</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('clinics.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Clinic Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Clinic Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Clinic Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="clinic-image-row row" id="clinic_image_wrapper">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label">Clinic Images</label>
                                        <input type="file" class="form-control" name="images[]">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:void(0);" class=" mt-3" id="add-clinic-image"> Add More </a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Add Clinic</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    document.getElementById('add-clinic-image').addEventListener('click', function() {
        const wrapper = document.getElementById('clinic_image_wrapper');
        const newRow = document.createElement('div');
        newRow.classList.add('col-md-12');
        newRow.innerHTML = `
            <div class="col-md-12">
               <div class="clinic-image-row row" id="clinic_image_wrapper">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label">Clinic Images</label>
                            <input type="file" class="form-control" name="images[]">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="javascript:void(0);" class="remove-clinic-image text-danger mt-2">
                            Remove
                        </a>
                    </div>
                </div>
        `;
        wrapper.appendChild(newRow);
    });
    $(document).on('click', '.remove-clinic-image', function () {
        $(this).closest('.clinic-image-row').remove();
    });
</script>
@endpush
