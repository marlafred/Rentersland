<div class="box box-default">
  <div class="box-body" style="padding:0px">
    <nav>
        <ul class="sidebar-menu">
            <li class="{{  Route::is('admin.pages') ? 'active' : '' }}">
                <a  href="{{ route('admin.pages') }}"><i class="fa fa-file-o"></i> Pages List </a>
            </li>
            <li class="{{  Route::is('admin.add.pages') ? 'active' : '' }}">
                <a  href="{{ route('admin.add.pages') }}"><i class="fa fa-plus"></i> Create New Page </a>
            </li>
        </ul>
    </nav>
   </div>
</div>		