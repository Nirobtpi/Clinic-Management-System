@extends('admin.layout.master')
@section('title', 'Edit State')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit State</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('states.update', $state->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">State Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $state->name) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-control" id="country_id" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option @selected($country->id == $state->country_id) value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <select class="form-control" id="city_id" name="city_id">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option @selected($city->id == $state->city_id) value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update State</button>
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
    $(document).ready(function () {
        $('#country_id').on('change', function () {
            var countryId = $(this).val();
            var url = '{{ route("country.cities", ":id") }}';
            url = url.replace(':id', countryId);
            if (countryId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option value="">Select City</option>');
                        $.each(data, function (key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Select City</option>');
            }
        });
    });
</script>
@endpush
