<div class="box box-default">
  <div class="box-body" style="padding:0px">
    <nav>
        <ul class="sidebar-menu">
            <li class="{{  Route::is('admin.email.register') ? 'active' : '' }}">
                <a  href="{{ route('admin.email.register') }}"><i class="fa fa-envelope"></i> New User </a>
            </li>
            <li class="{{  Route::is('admin.email.register.notify') ? 'active' : '' }}">
                <a  href="{{ route('admin.email.register.notify') }}"><i class="fa fa-envelope"></i> New User Notify </a>
            </li>
            <li class="{{  Route::is('admin.new.listing') ? 'active' : '' }}">
                <a  href="{{ route('admin.new.listing') }}"><i class="fa fa-envelope"></i> New Listing </a>
            </li>
            <li class="{{  Route::is('admin.new.listing.notify') ? 'active' : '' }}">
                <a  href="{{ route('admin.new.listing.notify') }}"><i class="fa fa-envelope"></i> New Listing Notify</a>
            </li>
            <li class="{{  Route::is('admin.email.renters.acc-active') ? 'active' : '' }}">
                <a  href="{{ route('admin.email.renters.acc-active') }}"><i class="fa fa-envelope"></i> Renters Account Active </a>
            </li>
            <li class="{{  Route::is('admin.email.landlord.acc-active') ? 'active' : '' }}">
                <a  href="{{ route('admin.email.landlord.acc-active') }}"><i class="fa fa-envelope"></i> Landlord Account Active</a>
            </li>
           
            
        </ul>
    </nav>
   </div>
</div>		