@extends('layouts.app')

@section('content')
<?php print_r($)?>
 
<div class="page-header">
    <h3 class="page-title"> Email Setting <span class="text-small font-weight-light ml-2">Configure your incoming mail server settings.</span> </h3>
    
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">   

<form method="POST" action="{{ route('user_mail_settings.store') }}" novalidate>
    @csrf
    <div class="form-group">
        <label for="primary_email">Primary Email</label>
        <input type="email" name="primary_email"  class="form-control"  value="{{ old('primary_email') }}" required>
        @error('primary_email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="secondary_email">Secondary Email</label>
        <input type="email" name="secondary_email"  class="form-control"  value="{{ old('secondary_email') }}" required>
        @error('secondary_email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="mail_server">Mail Server</label>
        <input type="text" name="mail_server"  class="form-control"  value="{{ old('mail_server') }}" required>
        @error('mail_server')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="port">Port</label>
        <input type="text" name="port"  class="form-control"  value="{{ old('port') }}" required>
        @error('port')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="protocol">Protocol</label>
        <input type="text" name="protocol"  class="form-control"  value="{{ old('protocol') }}" required>
        @error('protocol')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password"  class="form-control"  value="{{ old('password') }}" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time"  class="form-control"  value="{{ old('start_time') }}" required>
        @error('start_time')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="end_time">End Time</label>
        <input type="time" name="end_time"  class="form-control"  value="{{ old('end_time') }}" required>
        @error('end_time')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="number" name="user_id"  class="form-control"  value="{{ old('user_id') }}" required>
        @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary me-2">Create User Mail Setting</button>
</form>
</div>
        </div>
    </div>    
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/user-email-settings.js')}}"></script>
@endsection