@extends('layouts.app')

@section('content')

 
<div class="page-header">
    <h3 class="page-title"> Email Setting <span class="text-small font-weight-light ml-2">Configure your incoming mail server settings.</span> </h3>
    
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">   
           
                @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>    

                    <strong>{{ $message }}</strong>

                </div>

                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- <form class="forms-sample" method="POST" action="{{ route('user_mail_settings.store') }}"> -->
                
                @if(isset($mailSetting))
                    <form id="email-settings-form" class="forms-sample" method="POST" action="{{ route('user_mail_settings.update', $mailSetting->id) }}">
                        @method('PUT')
                @else
                    <form id="email-settings-form" class="forms-sample" method="POST" action="{{ route('user_mail_settings.store') }}">
                @endif
                @csrf
                    <div class="form-group">
                        <label for="primary-email">Primary Email</label>
                        <!-- <input type="email" name="primary_email" class="form-control" id="primary-email" required placeholder="Primary Email"  autocomplete="off"> -->
                        <input type="email" name="primary_email" class="form-control" id="primary-email"  placeholder="Primary Email"  autocomplete="off" value="{{ isset($mailSetting) ? $mailSetting->primary_email : '' }}">
                        
                        @error('primary_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <!-- <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="off"> -->
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Password" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="mail-server">Mail Server</label>
                        <select class="form-control" name="mail_server" style="width:100%" id="mailserver">    
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
                        <label>Start and End Time</label>
                        <div class="input-group" style="gap:20px;">
                            <input type="text" class="form-control timepicker" name="start_time" id="start-time" value="{{ isset($mailSetting) ? $mailSetting->start_time : '' }}" required data-toggle="datetimepicker" data-target="#start-time" placeholder="Select start time">
                            <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <input type="text" class="form-control timepicker" name="end_time"  id="end-time" value="{{ isset($mailSetting) ? $mailSetting->end_time : '' }}" required data-toggle="datetimepicker" data-target="#end-time" placeholder="Select end time">
                            <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                        </div>

                    <div class="form-group">
                        <label for="secondary-email">Secondary Email</label>
                        <input type="email" name="secondary_email" class="form-control" value="{{ isset($mailSetting) ? $mailSetting->secondary_email : '' }}" id="secondary-email" placeholder="Secondary Email">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
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