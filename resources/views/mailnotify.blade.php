@extends('layouts.app')

@section('content')
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
<div class="page-header">
    <h3 class="page-title"> Get Mail Status </h3>
    
</div>
<button id="getMailInfo" class="btn btn-info btn-rounded btn-fw">Click me</button>
<br><br>
<div style="overflow-x:auto;">
<table class="table table-bordered" id="mailcontent">
  <thead>
    <tr>
      <th>From</th>
      <th>Sentiment</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <td colspan="2">No data available</td>
    </tr>
  </tbody>
</table>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/mailnotify.js')}}"></script>
@endsection