@extends('adminlte::page')

@section('title', 'Landlords')

@section('content_header')
   
@stop

@section('content')

@include('admin.search.user-search')

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #c5dcf1;">
        <b><i class="fa fa-user"></i> &nbsp;Landlords List </b>
    </div>
    <div class="box-header">
    
    
    <div class="row">
    <form method="get" id="update_multi" onsubmit="return false;">
        {{ csrf_field() }}
        <div class="form-group col-sm-3">
            <label class="control-label">Update Status</label>
            <select class="form-control" name="status">
                <option value=""> Choose Status </option>
                <option value="1"> Active </option>
                <option value="0"> InActive </option>
            </select>
        </div> <!--col-sm-3-->
        <div class="form-group col-sm-2">
          <label class="control-label hidden"></label><br>
          <input type="submit" value="Update" class="btn btn-success btn-block">
        </div> <!--col-sm-2-->
        <div class="form-group col-sm-2">
            <label class="control-label hidden"></label><br>
            <button type="button" class="btn btn-danger" id="delete_multi" > 
                <i class="fa fa-trash"></i> Delete Selected 
            </button>
        </div> <!--col-sm-2-->
        
        <div id="user_ids">
            
        </div>
        <input type="hidden" name="user_type" value="landlord_activate">
    </form>
    </div>
    
    <div class="clearfix"></div>
   
    <div class="box-body" style="overflow-x: auto;padding: 0;">
        
        <table id="users" class="display" cellspacing="0" width="100%" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th class="no-sort">Sr#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Listings</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th class="no-sort">Action</th>
                    <th class="no-sort text-center"> <input type="checkbox" id="mark_all"> All</th>
                </tr>
            </thead>
            <tbody>
                <?php $pos=1 ?>
                @foreach ($users as $user)
                <tr>
                    <td class="text-center"><?php print $pos++ ?></td>
                    <td>{{ $user->first_name }}  {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td class="text-center"><span class="badge">{{ count($user->listing) }}</span></td>
                    <td>
                       @if($user->status=='1') 
                       <span class="text-success"> Active </span>
                        @else
                        <span class="text-danger"> In-Active </span>
                       @endif 
                    </td>
                    <td>{{ date('M j -Y, H:i a', strtotime($user->created_at)) }}</td>
                    <td>
                        <a href="javascript:void(0);" class="text-danger delete-this" rel-id="{{ $user->id }}"><i class="fa fa-trash"></i> Delete</a>
                        <br>
                        <a href="{{route('edit.user', $user->id)}}" class="text-primary edit-this"><span class="fa fa-pencil"></span> Edit</a>
                    </td>
                    <td>
                        <input type="checkbox" name ="id[]" class="my_selected" value="{{ $user->id }}">
                    </td>
                    
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
	
@stop

@section('css') 

@stop

@section('js')
    <script>
        $(document).ready(function() {
                $('#users').DataTable( {
                    "bPaginate": false,
                    "bFilter": false,
                    "bInfo": false,
                    "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            });
        });
    </script>
    
    <script>
        $(document).ready(function(){
           $('.delete-this').on('click', function(e){
              var rel_id = $(this).attr('rel-id');
              token = $('meta[name="csrf-token"]').attr('content');
              if(confirm("Are you sure to delete this ??")){
                  $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                  $('.cd-popup-trigger').click();
                    $.ajax({
                        url: '{{ route("delete.user") }}',
                        data: {rel_id:rel_id, _token: token},
                        type: 'POST',
                        success: function(data){
                            console.log(data);
                           if(data=='success'){
                             setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Deleted Successfully..!!</span>');
                             },1000);
                             setTimeout(function(){  
                                window.location.href = '';
                             },2000);
                           }else{
                            setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                             },1000);
                                
                           }
                        }//success
                    });//ajax
              }
           }); /*delete this*/
           
           $("#delete_multi").on('click', function(){
                var rec_ids = [];
		$.each($(".my_selected:checked"), function(){            
		   rec_ids.push($(this).val());
		});                
                if(rec_ids==''){
                    alert("Select Records to Delete...!");
                    return false;
		}
                
                token = $('meta[name="csrf-token"]').attr('content');
                if(confirm("Selected Records Will be Deleted..!! ??")){
                    
                    $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                    $('.cd-popup-trigger').click();
                    $.ajax({
                        url: '{{ route("delete.multiple.users") }}',
                        data: {rec_ids:rec_ids, _token: token},
                        type: 'POST',
                        success: function(data){
                            console.log(data);
                           if(data=='success'){
                             setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Deleted Successfully..!!</span>');
                             },1000);
                             setTimeout(function(){  
                                window.location.href = '';
                             },2000);
                           }else{
                            setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                             },1000);
                           }
                        }//success
                    });//ajax
                }
           });/*delete_multi*/
           
           $("#update_multi").on('submit', function(){
                $.each($(".my_selected:checked"), function(){            
		   $('#user_ids').append('<input type="hidden" class="multi_ids" name="user_ids[]" value="'+$(this).val()+'">');
		});            
               
               if($(this).find('.multi_ids').length < 1){
                   alert("No Users Selected...!!");
                   return false;
               }
               
                $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                $('.cd-popup-trigger').click();
                $.ajax({
                    url: '{{ route("update.multiple.users") }}',
                    data: $(this).serialize(),
                    type: 'POST',
                    success: function(data){
                        console.log(data);
                       if(data=='success'){
                         setTimeout(function(){  
                             $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Updated Successfully..!!</span>');
                         },1000);
                         setTimeout(function(){  
                            window.location.href = '';
                         },2000);
                       }else{
                        setTimeout(function(){  
                             $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                         },1000);
                       }
                    }//success
                });//ajax
                
           });/*update_multi*/
           
        });
    </script>
@stop
