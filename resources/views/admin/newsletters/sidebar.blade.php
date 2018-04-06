<div class="box box-default">
  <div class="box-body" style="padding:0px">
    <nav>
        <ul class="sidebar-menu">
            <li class="{{  Route::is('admin.newsletters') ? 'active' : '' }}">
                <a  href="{{ route('admin.newsletters') }}"><i class="fa fa-envelope"></i> Newsletters </a>
            </li>
            <li class="{{  Route::is('admin.create.newsletter') ? 'active' : '' }}">
                <a  href="{{ route('admin.create.newsletter') }}"><i class="fa fa-plus"></i> Create Newsletter </a>
            </li>
            <li class="{{  Route::is('admin.subscribers') ? 'active' : '' }}">
                 <a  href="{{ route('admin.subscribers') }}"><i class="fa fa-list"></i> Subscribers List </a>
            </li>
            <li class="{{  Route::is('admin.send.newsletter') ? 'active' : '' }}">
                 <a  href="{{ route('admin.send.newsletter') }}"><i class="fa fa-clock-o"></i> Send Newsletter </a>
            </li>
            <li class="{{  Route::is('admin.log') ? 'active' : '' }}">
                 <a  href="{{ route('admin.log') }}"><i class="fa fa-clock-o"></i> Newsletters Log </a>
            </li>
            
        </ul>
    </nav>
   </div>
</div>		