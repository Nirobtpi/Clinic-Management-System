@extends('admin.layout.master')
@section('title', 'Stripe Payment')
@section('content')

    <div class="row">
        <div class="col-12">
            <!-- General -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stripe Payment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('stripe.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Stripe Key</label>
                            <input type="text" name="stripe_key" value="{{ old('stripe_key',$stripe?->stripe_key) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Stripe Cecret Key</label>
                            <input type="text" name="stripe_secret_key" value="{{ old('stripe_secret_key',$stripe?->stripe_secret_key) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- /General -->

        </div>
    </div>
@endsection
