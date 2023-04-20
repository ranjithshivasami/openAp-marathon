@extends('layouts.auth')

@section('content')
<div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Mail Notification</h3>
</div>
@if(isset($message))
    <div class="alert alert-success">{{ $message }}</div>
@endif
<a href="{{ url('sendnotification') }}" class="btn btn-info btn-rounded btn-fw">Send Notification</a>

<!-- <button id="sendmailnotification" class="btn btn-info btn-rounded btn-fw">Send Notification</button> -->
<br><br>


@endsection

