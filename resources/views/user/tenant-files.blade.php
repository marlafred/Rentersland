@extends('master')

@section('title', 'Tenants Listings')

@section('body')

@include('user.rental-sidebar')
<!-- Content Area -->
<div class="col-sm-9 dash-content">
    <div class="col-sm-12 clmn">
        <div class="alert-box">
            <h4 class="heading"> <b> Documents Submitted ( {{ count($files) }} )</b> </h4>
            <!-- Listings -->
            <div class="content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="no-sort">Sr#</th>
                            <th>Doc Title</th>
                            <th>Doc Description</th>
                            <th>File</th>
                            <th>User</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($files) and count($files)>0)
                        <?php $pos = 1; ?>
                        @foreach($files as $file)
                        <tr>
                            <td><?php print $pos++ ?></td>
                            <td>{{ $file->doc_title }}</td>
                            <td>{{ $file->doc_description }}</td>
                            <td><a href="{{ asset('static/') }}/{{ $file->file_name }}" target="_blank">View File</a></td>
                            <td>{{ $file->user->first_name }} {{ $file->user->last_name }}</td>
                            <td>{{ date('M j -Y, H:i a', strtotime($file->created_at)) }}</td>
                            <td>{{ $file->created_by }}</td>
                            <td>
                                @if($file->created_by!='Admin')
                                    <a href="javascript:void(0);" class="text-danger delete-this" rel-id="{{ $file->id }}"><i class="fa fa-trash"></i> Delete</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr><td colspan="8">No Docs Found..!!</td></tr>
                        @endif
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="inner-heading">Upload New</div>
                    <form method="post" id="tenant_files" enctype="multipart" onsubmit="return false;">
                        {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label>Doc Title</label>
                            <input type="text" required="" class="form-control" name="doc_title" value="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Doc Description</label>
                            <textarea class="form-control" name="doc_description" placeholder="Enter Something about document.."></textarea>
                        </div>
                        <div class="form-group col-sm-10">
                            <div class="img-block img-size-1">
                                <div class="ib-container-block">
                                    <div class="input-container">
                                     <div class="input-group">
                                         <span class="input-group-btn">
                                             <span class="btn btn-red btn-file" style="padding: 13px 33px;">
                                                 <input required="" type="file" name="file" class="file">
                                             </span>
                                         </span>
                                         <input type="text" readonly placeholder="No Icon Selected" class="form-control file_val">
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="form-group col-sm-2">
                        <button style="width: 100%;" type="submit" class="btn btn-blue">Submit</button>
                    </div>
                </form>
            </div><!--div-md-6-->
        </div>
    </div>
    <!-- /Listings -->
</div>
</div><!--dash-content-->
@stop

@section('script')
    <script> 
        $(document).ready(function(){
            
            $(document).on('change','.file', function(e){
                
                var fileExtension = ['jpeg', 'jpg', 'png', 'bmp', 'pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only formats are allowed : "+fileExtension.join(', '));
                    $(this).val('');
                    return false;
                } 
                
                
               $(this).parents('.input-group').find('.file_val').val($(this).val());
           });
            
            $('#tenant_files').on('submit', function(e){
               $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
               $('.cd-popup-trigger').click();
              
               $.ajax({
                    type:"POST",
                    url:"{{ route('tenant.submit.files') }}",
                    data: new FormData($('#tenant_files')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data){
                        if(status!='error'){
                            setTimeout(function(){  
                                $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Updated Successfully..!!</span>');
                            },1000);
                            setTimeout(function(){  
                                window.location.href = '';
                             },2000);
                        }else{
                           $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                        } 
                    }

                });//ajax
                
            });
            
            
            $('.delete-this').on('click', function(e){
              var rel_id = $(this).attr('rel-id');
              token = $('meta[name="csrf-token"]').attr('content');
              if(confirm("Are you sure to delete this ??")){
                  $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                  $('.cd-popup-trigger').click();
                    $.ajax({
                        url: '{{ route("delete.files") }}',
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
           }); /*delete-this*/
    
    
        });/*ready*/
    </script>
    
@stop