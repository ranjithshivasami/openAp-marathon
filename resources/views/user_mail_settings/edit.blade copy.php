@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User Mail Setting') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user_mail_settings.update', $userMailSetting->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="primary_email" class="col-md-4 col-form-label text-md-right">{{ __('Primary Email') }}</label>

                            <div class="col-md-6">
                                <input id="primary_email" type="email" class="form-control @error('primary_email') is-invalid @enderror" name="primary_email" value="{{ old('primary_email', $userMailSetting->primary_email) }}" required autocomplete="primary_email" autofocus>

                                @error('primary_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="secondary_email" class="col-md-4 col-form-label text-md-right">{{ __('Secondary Email') }}</label>

                            <div class="col-md-6">
                                <input id="secondary_email" type="email" class="form-control @error('secondary_email') is-invalid @enderror" name="secondary_email" value="{{ old('secondary_email', $userMailSetting->secondary_email) }}" required autocomplete="secondary_email" autofocus>

                                @error('secondary_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mail_server" class="col-md-4 col-form-label text-md-right">{{ __('Mail Server') }}</label>

                            <div class="col-md-6">
                                <input id="mail_server" type="text" class="form-control @error('mail_server') is-invalid @enderror" name="mail_server" value="{{ old('mail_server', $userMailSetting->mail_server) }}" required autocomplete="mail_server" autofocus>

                                @error('mail_server')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="port" class="col-md-4 col-form-label text-md-right">{{ __('Port') }}</label>

                            <div class="col-md-6">
                                <input id="port" type="text" class="form-control @error('port') is-invalid @enderror" name="port" value="{{ old('port', $userMailSetting->port) }}" required autocomplete="port" autofocus>

                                @error('port')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="protocol" class="col-md-4 col-form-label text-md-right">{{ __('Protocol') }}</label>

                            <div class="col-md-6">
                                <input id="protocol" type="text" class="form-control
                                    @error('protocol')
                                    <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $userMailSetting->password) }}" required autocomplete="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time', $userMailSetting->start_time) }}" required autocomplete="start_time" autofocus>

                                @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_time" type="text" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time', $userMailSetting->end_time) }}" required autocomplete="end_time" autofocus>

                                @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>