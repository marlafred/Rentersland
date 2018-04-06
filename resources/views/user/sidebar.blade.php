<!-- Sidebar -->
<div class="dash-sidebar col-sm-3">
<div class="float-box">
    <h4 class="title"> <b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </b></h4>
    <hr>
    <ul>
        <li><a href="{{ route('user.dashboard') }}"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard </a></li>
        <li><a href="{{ route('user.listings') }}"><i class="fa fa-building-o" aria-hidden="true"></i> Listings </a></li>
        <li><a href="{{ route('user.tenant.listings') }}"><i class="fa fa-building-o" aria-hidden="true"></i> RENTERS </a></li>
        @if(Auth::user()->status==1)
            <li><a href="{{ route('renters.list') }}"><i class="fa fa-book" aria-hidden="true"></i> Tenant Stats™ </a></li>
        @endif
        <!--<li><a href="{{ route('user.favourites') }}"><i class="fa fa-heart" aria-hidden="true"></i> Favourotis</a></li>-->
        <li><a href="{{ route('user.tour.requests') }}"><i class="fa fa-tripadvisor" aria-hidden="true"></i> Requests</a></li>
        <li><a href="{{ route('user.profile') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile </a></li>
        <li><a href="{{ route('user.change.password') }}"><i class="fa fa-key" aria-hidden="true"></i> Change Password </a></li>
        
    </ul>
</div>	
</div>	
<!-- /Sidebar -->
