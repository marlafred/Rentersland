@extends('master')

@section('title', 'User Listings')

@section('body')

    @include('user.sidebar')
    <!-- Content Area -->
    <div class="col-sm-9 dash-content">
        <div class="col-sm-12 clmn">
        <div class="alert-box">
        <h4 class="heading"> <b>Current Listings ( {{ count($listings) }} )</b> </h4>

        <!-- Listings -->
        <div class="col-sm-12 listing-items">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Address</td>
                        <td>Price</td>
                        <td>Date Created</td>
                        <td>Views</td>
                        <td>Options</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @if(count($listings) > 0)
                        @foreach($listings as $list)
                            <tr>
                                <td><?php print $count++; ?></td>
                                <td>
                                    @foreach ($list->listingimages as $images)
                                        @if ($loop->first)
                                            <img src="{{ asset('uploads/'.$images->image) }}" width="60" />
                                        @endif
                                    @endforeach
                                </td>
                                <td><strong>{{ $list->title }}</strong></td>
                                <td>{{$list->address}}</td>
                                <td>${{ $list->price }}</td>
                                <td>{{ date('M j Y, H:i a', strtotime($list->created_at)) }}</td>
                                <td><?php echo $count ?></td>
                                <td>
                                    <a href="{{ route('detail.listing') }}/{{ $list->slug }}" class="btn btn-info btn-block"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('ceate.listing') }}/{{ $list->slug }}" class="btn btn-clrd btn-block"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-block delete-this" rel-id='{{ $list->id }}'><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="8">No Record Found..!!</td></tr>
                    @endif

                </tbody>
            </table>
            
            
            <div class="clearfix"></div>
           
            <div class="form-group col-sm-12 text-center">
                <a href="{{ route('ceate.listing') }}" class="btn btn-red"> Create New Listing </a>
            </div>  
            <div class="clearfix"></div>
            
        </div>
        <!-- /Listings -->
        </div>
        </div>
    </div><!--dash-content-->

@stop

@section('script')
<script>
    $(document).ready(function(){
           $('.delete-this').on('click', function(e){
              var rel_id = $(this).attr('rel-id');
              token = $('meta[name="csrf-token"]').attr('content');
              if(confirm("Are you sure to delete this ??")){
                  $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                  $('.cd-popup-trigger').click();
                    $.ajax({
                        url: '{{ route("user.delete.listing") }}',
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
    });
    
</script> 

@stop
