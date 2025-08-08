@extends('admin.layout.master')
@section('title', 'Create City')
@section('content')

<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create City</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('cities.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">City Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-control" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Add City</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
