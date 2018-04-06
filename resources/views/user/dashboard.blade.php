@extends('master')
@section('title', 'User Dashboard')
@section('body')

@include('user.sidebar')
<!-- Content Area -->
<div class="col-sm-9 dash-content">
    
    <div class="alert-box">
        <h4 class="heading"> <b>Dashboard</b> </h4>
    </div>
    
    <!-- Options Grid -->
    <div class="opt-grid" style="margin-top: 10px;">
      <div class="row">
        <div class="col-sm-3">
            <a href="{{ route('user.listings') }}" class="optionbox">
                <h4><i class="fa fa-building-o" aria-hidden="true"></i> Listings</h4>
                <span class="badge">{{ $listings }}</span>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="{{ route('ceate.listing') }}" class="optionbox">
                <h4><i class="fa fa-building-o" aria-hidden="true"></i> Create Listing</h4>
                <span class="badge">&nbsp;</span>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="{{ route('user.tenant.listings') }}" class="optionbox">
                <h4><i class="fa fa-paper-plane" aria-hidden="true"></i> Renters </h4>
                <span class="badge">{{ $applies }}</span>
             
            </a>
        </div>
        <div class="col-sm-3">
            <a href="{{ route('user.tour.requests') }}" class="optionbox">
                <h4><i class="fa fa-tripadvisor" aria-hidden="true"></i> Requests </h4>
                <span class="badge">{{ $requests }}</span>
             
            </a>
        </div>
       
          <div class="clearfix"></div>
          
      </div>
    </div>
    <!-- /Options Grid -->
    
    
</div><!--dash-content-->

@stop