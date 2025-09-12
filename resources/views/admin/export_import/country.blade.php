@extends('admin.layout.master')
@section('title', 'Country Export Import')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-12 col px-5">
                    <a href="{{ route('export.country.download') }}" class="btn btn-primary float-right mt-2 mr-2">Export All Country</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('import.country') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select File</label>
                                <input type="file" class="form-control" name="file">
                                <a href="{{ route('export.sample.data') }}" class="mt-2">Download Sample File</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
