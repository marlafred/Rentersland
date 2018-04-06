@extends('master')

@section('title', 'Tenants List')

@section('body')

    @include('user.sidebar')
    <!-- Content Area -->
    <div class="col-sm-9 dash-content">
        <div class="alert-box" style="margin-top:0px;">
            <h4 class="heading"> <b> Tenants Stats™  ( {{ count($users) }} )</b> </h4>
        </div>
        <!-- Listings -->
        <div class="col-sm-12 listing-items">
            
            <div class="search_filters">
                <form method="get" action="">
                    <div class="row">
                        <div class="col-md-3">
                          <label>Filter By Town</label>
                          <?php $gtown = isset($_GET['town'])?$_GET['town']:''  ?>
                          <select class="search-select" name="town">
                              <option value="">All Towns</option>
                                @if(count($states) > 0)
                                @foreach($states as $state)
                                        <option value="{{ $state->town }}" @if($gtown==$state->town) selected @endif >{{ $state->town }}</option>
                                @endforeach
                                @endif
                          </select>
                        </div><!--col-md-3-->
                        
                        <div class="col-md-3">
                            <button class="search-button" type="submit">
                                Apply Filter
                            </button>
                        </div><!--col-md-3-->
                        
                    </div><!--row-->
                </form>
            </div><!--search_filters-->
            
            
            <table class="table table-striped" id="tenant_listing">
                <thead>
                    <tr>
                        <th class="no-sort">Sr#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Bedrooms Req.</th>
                        <th>Intr. Towns</th>
                        <th>Details</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center"><?php print $count++ ?></td>
                                <td>{{ $user->first_name }}  {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->bedrooms }}+</td>
                                <td>{{ $user->towns }}</td>
                                <td>
                                    <a href="{{ route('view.tenant.app') }}/{{ $user->id }}" class="text-danger">
                                        <i class="fa fa-eye"></i> View Profile
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="8">No Tenants Found..!!</td></tr>
                    @endif

                </tbody>
            </table>
        </div>
        <!-- /Listings -->
    </div><!--dash-content-->

@stop

@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script>
jQuery(document).ready(function() {
    jQuery('#tenant_listing').DataTable({searching: false, paging: false, bInfo: false});
} );
</script>

<style>
.td-main-content-wrap.td-container-wrap{
	min-height:480px;
}
.search_filters{
	padding-bottom: 1%;
	border-bottom: 1px solid #e5e5e5;
}
.search-select{
    background-color: #ffffff;
    color:  #5f5f5f;
    box-sizing: border-box;
    width: 240px;
    box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
    padding: 12px 18px;
    border: 1px solid #dbdbdb;
}

.search-button{
    border-radius: 2px;
    background-color:  #6caee0;
    color: #ffffff;
    font-weight: bold;
    box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
    padding: 10px 22px;
    border: 0;
    margin-top: 28px;
}

</style>

@stop