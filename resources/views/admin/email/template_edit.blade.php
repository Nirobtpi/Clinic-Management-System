@extends('admin.layout.master')
@section('title', 'Email Edit')
@section('content')

<div class="row">
    <div class="col-8 offset-2">

        <!-- Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h4 class="mb-0">{{ __('Dynamic Keyword') }}</h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('Keyword') }}</th>
                                <th scope="col">{{ __('Meaning') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @php
                                        $name = "{{user_name}}";
                                    @endphp
                                    <span class="fw-bold text-primary">{{ $name }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ __('User Name') }}</span>
                                </td>
                                <td>
                            </tr>
                            <tr>
                                <td>
                                    @php
                                    $verification_link = "{{verification_link}}";
                                    @endphp
                                    <span class="fw-bold text-primary">{{ $verification_link }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ __('Verification Link') }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Card -->

    </div>
</div>


<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Email Edit</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('email.template.update', $template->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject"
                                    value="{{ $template->subject ?? old('subject') }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Body</label>
                                <textarea class="form-control" id="summernote" name="description"
                                    rows="5">{{ $template->description }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });

</script>
@endpush
