<div class="container">
	<div class="logo-wrapper">
		
        <?php
        $logo_class = 'left';
        if($setting->logo_position=='center'){
            $logo_class = 'centered';
        }
        else if($setting->logo_position=='right'){
            $logo_class = 'right';
        }
        ?>

		<a href="{{ route('home') }}" class="logotop {{ $logo_class }}">
			@if($setting->logo)
				<img src="{{ asset('static/') }}/{{ $setting->logo }}" alt="{{ $setting->title }}"/>
			@else
				<img src="{{ asset('images/logo.png') }}" alt="{{ $setting->title }}" />
			@endif
		</a>

		@if(Auth::guest())

			<a href="{{ route('tenant.register') }}" class="btn btn-red pull-right">apply now</a>

		@else
			<a href="{{ route('listings') }}" class="btn btn-red pull-right">apply now</a>
		@endif
	</div>
</div>
<!-- /Logo Area -->

<!-- Menu -->
<div class="main-menu">
	<div class="container">
		<i class="fa fa-chevron-circle-down dropdown-trigger"></i>
		<ul class="menu-links">
                    @if(count($navigation) > 0)
                        @foreach($navigation as $nav)

                            @if(isset($nav->pages->label))
                                <li><a href="{{ url('/') }}/{{ $nav->pages->slug }}">{{ $nav->pages->label }}</a></li>
                            @endif

                        @endforeach
                    @endif

		</ul>
		<ul class="right-links">
			<li>
				@if (Auth::guest())
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <i class="fa fa-sign-in"></i> Login <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu acounts_affix" role="menu">
                                        <li>
                                            <a href="{{ route('renters.login') }}">
                                                <i class="fa fa-user"></i> Renter Login 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('landlord.login') }}">
                                                <i class="fa fa-home"></i> Landlord/Owner Login 
                                            </a>

                                        </li>
                                    </ul>
				@else
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <i class="fa fa-user"></i> {{ Auth::user()->first_name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                          
                                        <li>
                                            @if(Auth::user()->user_type=='Tenant')
                                                <a href="{{ route('listings') }}">
                                                        <i class="fa fa-building-o"></i> Apply Now
                                                </a>
                                            @else
                                                <a href="{{ route('ceate.listing') }}">
                                                        <i class="fa fa-building-o"></i> Create Listing
                                                </a>
                                            @endif

                                        </li>
                                        <li>
                                                <a href="{{ route('user.dashboard') }}">
                                                        <i class="fa fa-dashboard"></i> Dashboard

                                                </a>

                                        </li>
                                        <li>
                                                <a href="{{ route('user.logout') }}">
                                                        <i class="fa fa-sign-out"></i> Logout
                                                </a>
                                        </li>
                                    </ul>

				@endif

			</li>
		
		</ul>
	</div>
</div>
<!-- /Menu -->




























