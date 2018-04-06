<div class="box box-default">
  <div class="box-body" style="padding:0px">
    <nav>
        <ul class="sidebar-menu">
            <li class="{{  Route::is('admin.settings') ? 'active' : '' }}">
                <a  href="{{ route('admin.settings') }}"><i class="fa fa-cog"></i> Genral Settings</a>
            </li>
            <li class="{{  Route::is('admin.navigation') ? 'active' : '' }}">
                <a  href="{{ route('admin.navigation') }}"><i class="fa fa-bars"></i> Main Navigation</a>
            </li>
            <li class="{{  Route::is('admin.footer.navigation') ? 'active' : '' }}">
                <a  href="#"  data-toggle="collapse" data-target="#footer" class="collapsed active"><i class="fa fa-bars"></i> Footer Navigation <i class="fa fa-angle-down" style="float: right;"></i></a>
                <ul class="sidebar-menu collapse {{  Route::is('admin.footer.navigation') ? 'in' : '' }}" id="footer" style="padding-left: 10%;">
                    
                    <li class="">
                        <?php $style = ''; ?>
                        @if(isset($type) and $type=='company')
                            <?php $style = 'style="text-decoration: underline; color:#000;"'; ?>
                        @endif
                        <a  href="{{ route('admin.footer.navigation') }}/company" <?php echo $style ?>><i class="fa fa-circle-o text-orange"></i> Company </a>
                    </li>
                    <li class="">
                        <?php $style = ''; ?>
                        @if(isset($type) and $type=='support')
                            <?php $style = 'style="text-decoration: underline; color:#000;"'; ?>
                        @endif
                        <a  href="{{ route('admin.footer.navigation') }}/support" <?php echo $style ?> ><i class="fa fa-circle-o text-lime"></i> Support </a>
                    </li>
                    <li class="">
                        <?php $style = ''; ?>
                        @if(isset($type) and $type=='short-links')
                            <?php $style = 'style="text-decoration: underline; color:#000;"'; ?>
                        @endif
                        <a  href="{{ route('admin.footer.navigation') }}/short-links" <?php echo $style ?> ><i class="fa fa-circle-o text-muted"></i> Short Links </a>
                    </li>
                </ul>
            </li>
             <li class="{{  Route::is('admin.states') ? 'active' : '' }}">
                 <a  href="{{ route('admin.states') }}"><i class="fa fa-globe"></i> Navigation Towns</a>
            </li>
        </ul>
    </nav>
   </div>
</div>		