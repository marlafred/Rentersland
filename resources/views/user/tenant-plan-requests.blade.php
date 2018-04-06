@extends('master')

@section('title', 'User Listings')

@section('body')

@include('user.rental-sidebar')
<!-- Content Area -->
<div class="col-sm-9 dash-content">
    <div class="col-sm-12 clmn">
        <div class="alert-box">
            <h4 class="heading"> <b>Current Requests ( {{ count($requests) }} )</b></h4>
            <div class="content">
                <a href="javascript:void(0)" class="text-primary"> Mark All Read </a>
                <!-- Listings -->
                <div id="accordion" role="tablist">
                    <?php $count = 1; ?>
                    @if(count($requests) > 0 )
                    @foreach($requests as $req)
                    <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                          <a data-toggle="collapse" href="#collapse-{{ $req->id }}" role="button" aria-expanded="true" aria-controls="collapseOne">
                            <b><i class="fa fa-user"></i> {{ $req->sender_name }} </b> 
                            <i class="fa fa-phone"></i> {{ $req->sender_phone }}
                            <i class="fa fa-calendar"></i> {{ date('M j, Y', strtotime($req->plan_date)) }}
                            <i class="fa fa-clock-o"></i> {{ ucfirst($req->plan_time) }}
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                    </h5>
                </div>
                <!-- /.card-header -->
                <div id="collapse-{{ $req->id }}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="message-details">
                            <?php print  nl2br ($req->sender_message); ?>
                        </div><!--message-details-->
                        <div class="replies">
                            @if($req->requests)
                            @foreach($req->requests as $reply)
                            <div class="sender"><b>
                                @if($reply->sender_id == Auth::id())
                                Sent
                                @else
                                Reply
                                @endif
                            </b></div>
                            {{ $reply->message }}
                            @endforeach
                            @endif
                        </div>
                        <div class="detail-footer">
                            <div class="listing pull-left"> <a href="{{ route('detail.listing') }}/{{ $req->listing->slug }}"> {{ $req->listing->title }} </a> </div>
                            <div class="listing pull-right"> 
                                <a href="javascript:void(0);" class="text text-primary mark-read" rel-id='{{ $req->id }}'> Mark as read </a>
                                <a href="javascript:void(0);" class="text text-primary reply-btn"> Reply </a>
                            </div>
                        </div><!--detail-footer-->
                        <div class="reply-box" style="display:none;">
                            <form class="reply-form" onsubmit="return false;">
                                {{ csrf_field() }}
                                <input type="hidden" name="req_id" value="{{ $req->id }}">
                                <div class="col-sm-12 form-group">
                                    <label>Reply:</label>
                                    <textarea class="form-control" name="message" placeholder="Write reply here..!!"></textarea>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <input type="submit" class="btn btn-clrd pull-right" value="Send">
                                </div>
                            </form>
                        </div><!--reply-box-->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div><!--card-->
            @endforeach
            @else
            <di class="no-rec-found"> No Requests Found..!! </di>
            @endif
        </div>
    </div>
</div>
</div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function(e){

        $('.reply-btn').on('click', function(e){
            $(this).parents('.card-body').find('.reply-box').toggle();
        });

        $('.reply-form').on('submit', function(){
           message = $(this).find('textarea').val(); 
           if(message!=''){
            $(this).find('textarea').parents('.form-group').removeClass('has-error');
            data = $(this).serialize();
            $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
            $('.cd-popup-trigger').click();
            $(this).find('.btn-clrd').attr('disabled',true);

            $.ajax({
                url: '{{ route("submit.reply") }}',

                data: data,
                type: 'POST',
                success: function(data){
                    console.log(data);
                    if(data=='success'){
                     setTimeout(function(){  
                         $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Request Sent Successfully..!!</span>');
                     },1000);
                 }else{
                     $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                 }
                    }//success
                });//ajax

        }else{
           $(this).find('textarea').parents('.form-group').addClass('has-error');
       }
   });

        $('.mark-read').on('click', function(){
            req_id = $(this).attr('rel-id');
            token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("mark.read") }}',

                data: { req_id: req_id, _token:token},
                type: 'POST',
                success: function(data){
                    console.log(data);
                    if(data=='success'){
                     setTimeout(function(){  
                         $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Request Sent Successfully..!!</span>');
                     },1000);
                 }else{
                     $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                 }
                }//success
            });//ajax
        });
    });
</script>
@stop