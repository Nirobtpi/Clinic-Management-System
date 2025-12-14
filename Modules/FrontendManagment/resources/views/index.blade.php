@extends('admin.layout.master')
@section('title', 'Frontend Sections List')
@section('content')
<div class="row">
    @foreach($settings as $key => $setting)
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $setting['name'] }}</h5>
                    <a href="{{ route('frontendmanagment.edit', ['frontendmanagment'=>$key,'lang_code'=>admin_lang()]) }}" class="btn btn-primary">Edit Section</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
