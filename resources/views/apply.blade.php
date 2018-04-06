@extends('master')
@section('title', 'Apply')
@section('body')
<style>
#newsletter{margin-top:0;}
</style>
<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Apply to millions of apartments with one application</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('listings') }}">Apply</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading --> 

<!-- Welcome Section -->
<div class="applywelcome">
<div class="container">
<div class="row">
<div class="col-sm-6">
<h3><strong>Search for Millions of Apartments</strong></h3>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
</div>

<div class="col-sm-6">
<img src="{{ asset('extra-images/listing.jpg') }}" alt="" class="img-responsive" />
</div>
</div>
</div>
</div>
<!-- /Welcome Section -->

<!-- Call to action -->
<div class="call-to">
<div class="container">
<h2>Instant apply to your favorites</h2>
<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem</p>
<a href="{{ route('register') }}" class="btn btn-clrd">sign up</a>
</div>
</div>
<!-- /Call to action -->
@stop