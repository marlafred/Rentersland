@extends('master')
@section('title') {{ $listing->title }} @stop
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>{{$listing->title}}</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('listings') }}">Listings</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="container">
    <div class="row">
        @include('templates.details.listing-detail-filters')
    </div>
    
    <div class="content-wrap">
        <div class="content-wrap">
            <div class="col-sm-12">
                <h2><strong>{{$listing->title}}</strong></h2>
                <div class="post-meta"><span><i class="fa fa-map-marker"></i> {{$listing->address}}</span></div>
            </div>
            
            <div class="col-sm-8">
                @include('templates.details.listing-detail-left')
                @include('templates.details.listing-detail-right')
                
                <div class="col-sm-12 posting-info">
                    <ul>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> Posted {{ $listing->created_at->diffForHumans() }}</li>
                        <li><i class="fa fa-eye" aria-hidden="true"></i> 3 </li>
                    </ul>
                </div>
                
                
                @include('templates.details.listing-detail')
                
                
            </div>
            
            <div class="col-sm-4">
                @include('templates.details.listing-detail-sidebar')
            </div>
            
            
        </div>
    </div>
</div>

@if($listing->lat == '')
    <?php $listing->lat = '37.2872357'; ?>
@endif
@if($listing->lng == '')
    <?php $listing->lng = '-121.9591312'; ?>
@endif

@stop

@section('script')
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">

<script>
    $(function () {
        
        $('.fancybox').fancybox();
        
        $('#datepicker').datetimepicker({
            format: "dd-mm-yyyy",
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
        });
                
        range = $('#range').val()*100;
        $('.price-range').html(range);

        $('#range').on('change', function(){
            range = $('#range').val()*100;
            $('.price-range').html(range); 
        });
        
        $(document).on("focusin", "#datepicker", function() {
            $(this).prop('readonly', true);  
         });

         $(document).on("focusout", "#datepicker", function() {
            $(this).prop('readonly', false); 
         });
        
        $(document).on('click', '.fake-radio', function(){
            var type = $(this).attr('type');
            $('#plan_time').val(type);
        });
        
        $(document).on('submit','#request_form', function(){
           var data = $(this).serialize();
           $('#tour-plan-modal').modal('hide');
           $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
           $('.cd-popup-trigger').click();
           element = $(this)[0];
           $(this).find('.btn-clrd').attr('disabled',true);
           $.ajax({
               url: '{{ route("submit.plan") }}',
               data: data,
               type: 'POST',
               success: function(data){
                  if(data=='success'){
                    //element.reset();
                    setTimeout(function(){  
                        $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Request Sent Successfully..!!</span>');
                    },1000);
                  }else{
                      $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                  }
               }//success
            });
        });//form
        
        /*
        * apply_now
        */
        $('.apply_now').on('click', function(){
           
            if($(this).parents('.modal-body').find('.share_now').is(':checked')){
                 $('.apply-response').html('<span class=""><i class="fa fa-spin fa-spinner"></i></span>');
                 var listId = $(this).attr('list-id');
                 var dealer_id = $(this).attr('dealer-id');
                 token = $('meta[name="csrf-token"]').attr('content');
                 $.ajax({
                    url: '{{ route("apply.listing") }}',
                    data: {listId:listId, dealer_id:dealer_id, _token: token},
                    type: 'POST',
                    success: function(data){
                       $('.apply-response').html(data);
                    }//success
                 });/*ajax*/
                 
            }else{
                $('.apply-response').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> You must agree to share information</span>');
            }
        });/*apply_now*/
        
    });
    
    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var latlng = new google.maps.LatLng('<?=$listing->lat?>','<?=$listing->lng?>');
         var map = new google.maps.Map(document.getElementById('map'), {
           center: latlng,
           zoom: 13
         });
         var marker = new google.maps.Marker({
           map: map,
           position: latlng,
           //draggable: true,
           anchorPoint: new google.maps.Point(0, 13)
        });
    }/*initialize*/

$(document).ready(function(){
     $(".fake-radio").on("click", function(){
      $(this).addClass("active").siblings().removeClass("active");
     })
   })
</script>

@stop