@extends('admin.layout.master')
@section('title', 'Theme Language List')
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Switch to language translation</h5>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    @foreach ($languages as $key => $lan)
                        <div class="gap-2 {{ $key == 0 ? '' : 'ml-3' }}">
                                <div class="d-flex align-items-center gap-1">
                                    @if(request()->get('theme_lang') == $lan->code)
                                        <i class="fe fe-eye mr-2"></i>
                                    @else
                                        <i class="fe fe-edit mr-2"></i>
                                    @endif
                                    <a href="{{ route('theme-language', ['theme_lang'=>$lan->code]) }}" >{{ $lan->name }} ({{ $lan->code }})</a>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card"></div>
            <div class="card-header">
                <h5 class="card-title">Theme Language List</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('theme-language.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="theme_lang" value="{{ request()->get('theme_lang') }}">
                        @foreach($datavalues as $key => $value)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{ $key }}</label>
                                    <input type="text" class="form-control" name="values[{{ $key }}]" value="{{ $value }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
    </div>
</div>
@endsection
