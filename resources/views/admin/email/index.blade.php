@extends('admin.layout.master')
@section('title', 'Email Configaration')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Email Configaration</h5>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('email.update') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Sender Name</label>
                                <input type="text" class="form-control" name="sender_name" value="{{ $email->sender_name ?? old('sender_name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $email->email ?? old('email') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Mail Host</label>
                                <input type="text" class="form-control" name="mail_host" value="{{ $email->mail_host ?? old('mail_host') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Smtp User Name</label>
                                <input type="text" class="form-control" name="smtp_user_name" value="{{ $email->smtp_user_name ?? old('smtp_user_name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Smtp Password</label>
                                <input type="text" class="form-control" name="smtp_password" value="{{ $email->smtp_password ?? old('smtp_password') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Mail Port</label>
                                <input type="text" class="form-control" name="smtp_port" value="{{ $email->smtp_port ?? old('smtp_port') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mail_encryption" class="form-label">Encryption</label>
                                <select name="mail_encryption" class="form-control" id="mail_encryption">
                                    <option value="">Select Encryption</option>
                                    <option value="tls" {{ $email->mail_encryption == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ $email->mail_encryption == 'ssl' ? 'selected' : '' }}>SSL</option>
                                </select>
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
