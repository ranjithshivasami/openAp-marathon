@extends('layouts.app')

@section('content')


<div class="page-header">
    <h3 class="page-title"> Email Setting <span class="text-small font-weight-light ml-2">Configure your incoming mail server settings.</span> </h3>

</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

               
                @endif
                @if(isset($mailSetting))
                <form id="email-settings-form" class="forms-sample" method="POST" action="{{ route('user_mail_settings.update', $mailSetting->id) }}">
                    @method('PUT')
                    @else
                    <form id="email-settings-form" class="forms-sample" method="POST" action="{{ route('user_mail_settings.store') }}">
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="primary-email">Primary Email</label>
                            <input type="email" name="primary_email" class="form-control" id="primary-email" placeholder="Primary Email" autocomplete="off" value="{{ isset($mailSetting) ? $mailSetting->primary_email : '' }}">

                            @error('primary_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm-password" placeholder="Password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="mail-server">Mail Server</label>
                            <select class="form-control" name="mail_server" style="width:100%" id="mail-server" required>
                                <option value="secure341.inmotionhosting.com" {{ isset($mailSetting) && $mailSetting->mail_server == 'secure341.inmotionhosting.com' ? 'selected' : '' }}>secure341.inmotionhosting.com</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="protocol">Protocol</label>
                            <select class="form-control" name="protocol" style="width:100%" id="protocol">
                                <option value="imap" {{ isset($mailSetting) && $mailSetting->protocol == 'imap' ? 'selected' : '' }}>IMAP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="port">Port</label>
                            <select class="form-control" name="port" style="width:100%" id="port">
                                <option value="465">465</option>
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
                            @error('start_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
                            @error('end_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="secondary-email">Secondary Email</label>
                            <input type="email" name="secondary_email" class="form-control" id="secondary-email" value="{{ isset($mailSetting) ? $mailSetting->secondary_email : '' }}" placeholder="Secondary Email">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <button class="ml-2 btn btn-dark">Cancel</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/user-email-settings.js')}}"></script>
@endsection