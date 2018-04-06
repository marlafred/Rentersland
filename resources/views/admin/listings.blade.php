@extends('adminlte::page')

@section('title', 'Listings')

@section('content')

@include('admin.search.listings-search')

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #c5dcf1;">
        <b><i class="fa fa-newspaper-o"></i> &nbsp;Listings </b>
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
        <div class="form-group col-sm-3">
            <label class="control-label">Update Ad Type</label>
            <select class="form-control" name="featured">
                <option value="">Choose Ad Type</option>
                <option value="1"> Featured </option>
                <option value="0"> Remove Featured </option>
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
        
        <div id="list_ids">
            
        </div>
        
    </form>
    </div>
    
    <div class="clearfix"></div>
   
    <div class="box-body" style="overflow-x: auto; padding: 0;">
        
        <table id="listing" class="display" cellspacing="0" width="100%" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th width="20" style="text-align:center;">Sr#</th>
                    <th class="no-sort">Thumbnail</th>
                    <th>Title</th>
                    <th>Address</th>
                    <th class="no-sort">Posted By</th>
                    <th>Price</th>
                    <th>Submit Date</th>
                    <th>Modify Date</th>
                    <th>Status</th>
                    <th class="no-sort">Featured</th>
                    <th>Plan Req</th>
                    <th class="no-sort">Action</th>
                    <th class="no-sort text-center"> <input type="checkbox" id="mark_all"> All</th>
                </tr>
            </thead>
            <tbody>
                <?php $pos=1 ?>
                @foreach ($listings as $list)
                
                <tr>
                    <td class="text-center"><?php print $pos++ ?></td>
                    <td>
                        @if($list->featured_image != '')
                            <img src="{{ asset('uploads/small_thumbs/'.$list->featured_image) }}" class="img-responsive" alt="" 
                                             style="width: 60px; height: 60px;" />
                            @else
                                @if(count($list->listingimages) > 0)
                                @foreach ($list->listingimages as $images)
                                    @if ($loop->first)
                                    <img src="{{ asset('uploads/small_thumbs/'.$images->image) }}" class="img-responsive" alt="" 
                                         style="width: 60px; height: 60px;" />
                                    @endif
                                @endforeach
                                @else
                                    <img src="{{ asset('images/no-image-small.png') }}" class="img-responsive" alt="" 
                                             style="width: 60px; height: 60px;" />
                                @endif
                        @endif
                    </td>
                    <td><a href="{{ route('admin.detail.listing') }}/{{ $list->slug }}" class="text-info">{{ substr($list->title , 0, 20)}}...</a></td>
                    <td>{{ $list->address }}</td>
                    <td>
                        @if(isset($list->users->email))
                        {{ $list->users->first_name }}  {{ $list->users->last_name }} 
                        <br> <span class="text-danger">{{ $list->users->email }}</span>
                        @else
                            {{ Auth::user()->name }}
                            <br> <span class="text-danger">{{ Auth::user()->email }}</span>
                        @endif
                        
                    </td> 
                    <td><b>$</b>{{ number_format($list->price) }}</td>
                    <td>{{ date('M j -Y, H:i a', strtotime($list->created_at)) }}</td>
                    <td>{{ date('M j -Y, H:i a', strtotime($list->updated_at)) }}</td>
                    <td>
                       @if($list->status=='1') 
                        <span class="text-success">Active</span>
                        @else
                        <span class="text-danger">In-Active</span>
                       @endif 
                    </td>
                    <td class="text-center">
                       @if($list->featured=='1') 
                        <i class='fa fa-heart text-danger'></i>
                        @else
                        <i class='fa fa-heart-o text-danger'></i>
                       @endif 
                    </td>
                    <td class="text-center"><span class="badge">{{ count($list->listingplans) }}</span></td>
                    <td>
                        <a href="{{ route('admin.detail.listing') }}/{{ $list->slug }}" class="text-info"><i class="fa fa-eye"></i> View</a> <br>
                        <a href="{{ route('admin.create.listings') }}/{{ $list->slug }}" class="text-primary"><i class="fa fa-pencil"></i> Edit</a> <br>
                        <a href="javascript:void(0);" class="text-danger delete-this" rel-id='{{ $list->id }}'><i class="fa fa-trash"></i> Delete</a>
                    </td>	
                    <td>
                        <input type="checkbox" name ="id[]" class="my_selected" value="{{ $list->id }}">
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
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        $(document).ready(function() {
                $('#listing').DataTable( {
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
                        url: '{{ route("delete.listing") }}',
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
                             },1500);
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
                        url: '{{ route("delete.multiple.listings") }}',
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
		   $('#list_ids').append('<input type="hidden" class="multi_ids" name="list_ids[]" value="'+$(this).val()+'">');
		});            
               
               if($(this).find('.multi_ids').length < 1){
                   alert("No Listings Selected...!!");
                   return false;
               }
               
                $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                $('.cd-popup-trigger').click();
                $.ajax({
                    url: '{{ route("update.multiple.listings") }}',
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
