@extends('master')
@section('title', 'User Dashboard')
@section('body')

@if(Auth::user()->user_type=='Tenant')
@include('user.rental-sidebar')
@else
@include('user.sidebar')
@endif

<!-- Content Area -->
<div class="col-sm-9 dash-content">
  <div class="col-sm-12 clmn">
    <div class="alert-box">
      <h4 class="heading"><b>Applicant View</b></h4>
      <div class="content">
          @include('templates.application.user-detail')
          @include('templates.application.user-docs')
      </div>
    </div>
  </div>
</div>
@stop