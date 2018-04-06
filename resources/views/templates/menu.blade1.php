<!-- Menubar -->
<div class="menubar">
        <div class="container">
                <a href="{{ route('home') }}" class="logotop pull-left">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" />
                </a>
                <div class="pull-right menu">
                        <ul>
                            <li>
                                        <a href="{{ route('home') }}">Home</a>
                                </li>    
                                
                            <li>
                                        <a href="{{ route('listings') }}">Listings</a>
                                </li>
                                
                                <li>
                                        <a href="{{ route('ceate.listing') }}">Post Listing</a>
                                </li>
                                
                                
                                <li>
                                     @if (Auth::guest())
                                        <a href="{{ route('user.login') }}" class="btn btn-clrd">sign in</a>
                                        @else
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                               {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{ route('user.dashboard') }}">
                                                        Dashboard
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user.logout') }}">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>

                                        @endif
                                    
                                </li>
                        </ul>
                       
                        
                </div>
        </div>
</div>
<!-- /Menubar -->