@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Email Setting <span class="text-small font-weight-light ml-2">Configure your incoming mail server settings.</span> </h3>
    
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">               
                <form class="forms-sample" method="POST" action="{{ route('user_mail_settings.store') }}">
                    <div class="form-group">
                        <label for="primary-email">Primary Email</label>
                        <input type="email" name="primary_email" class="form-control" id="primary-email" placeholder="Primary Email" autocomplete="off">
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
                        <select class="form-control" style="width:100%" id="mail-server">    
                        <option></option>                            
                                <option value="secure341.inmotionhosting.com">secure341.inmotionhosting.com</option>                               
                              </select>
                    </div>
                    <div class="form-group">
                        <label for="protocol">Protocol</label>
                        <select class="form-control" style="width:100%" id="protocol"> 
                        <option value="imap">IMAP</option>  
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="port">Port</label>
                        <select class="form-control" name="port" style="width:100%" id="port"> 
                        <option value="imap">465</option>  
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="secondary-email">Secondary Email</label>
                        <input type="email" name="secondary_email" class="form-control" id="secondary-email" placeholder="Secondary Email">
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