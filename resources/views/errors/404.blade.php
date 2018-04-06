@extends('master')
@section('title', 'Apply')
@section('body')
<style>
#newsletter{margin-top:0;}
</style>
<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Page Not Found</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('listings') }}">Listings</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
<div class="overlay-box text-center">
   <h3><strong>Oops! We couldn't find that page.</strong></h3>
<p>In the meantime, maybe try the following?</p>
<a href="{{ route('listings') }}" class="btn btn-clrd">Find an Apartment</a>
<a href="{{ route('ceate.listing') }}" class="btn btn-white">Post your Rental</a>
<br><br><br>
<img src="{{ asset('extra-images/slide-1.jpg') }}" alt="" class="img-responsive" />
</div>
</div>

@stop