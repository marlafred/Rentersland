@extends('master')
@section('title', 'Lenders Listing')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Listings</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('listings') }}">Listings</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="container">
    <div class="row">
        @include('templates.listings.listing-filters')
    </div>
    
    <div class="content-wrap">
        <div class="content-wrap">
            <div class="col-sm-8">
                @include('templates.listings.listing-left')
            </div>
            
            <div class="col-sm-4">
                @include('templates.listings.listing-sidebar')
            </div>
            
            @include('templates.listings.listing-bottom')
            
            <?php $locations=array(); $count= 1; ?>
            @if($listings)
                @foreach ($listings as $list)
                    @if($list->lat!='')
                        <?php $locations[]=array( 'name'=>$list->address, 'lat'=>$list->lat, 'lng'=>$list->lng ); ?>
                        <?php $count++; ?>
                    @endif
                @endforeach
            @endif
            
        </div>
    </div><!--content-wrap-->
</div>

@stop

<?php $markers = json_encode( $locations ); ?>

@section('script')
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">

<script>
    $(function () {
        range = $('#range').val()*100;
        $('.price-range').html(range);
            
        $('#range, #property_type, #bedrooms, #bathrooms').on('change', function(){
            range = $('#range').val()*100;
            $('.price-range').html(range);
            searchResults();
        });
        
        $('.datepicker').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
        });
        
        $('.modal').on('show.bs.modal', function () {
            $('.step1').show();
            $('.step2').hide();
        });
        
        $('.fake-radio').on('click', function(){
            var type = $(this).attr('type');
            $('#plan_time').val(type);
        });
        
        $(document).on('click','.next-btn', function(){
            if(step1_validation($(this))){
                $('.step1').hide();
                $('.step2').show();
            }
        });
        
        $(document).on('click','.back-btn', function(){
            $('.step1').show();
            $('.step2').hide();
        });
        
        $(document).on('submit','.request_form', function(){
           var data = $(this).serialize();
           $('.step2').hide();
           $(this).find('.btn-clrd').attr('disabled',true);
           $(this).parents('.modal').modal('hide');
           $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
	   $('.cd-popup-trigger').click();
           
           $.ajax({
               url: '{{ route("submit.plan") }}',
               data: data,
               type: 'POST',
               success: function(data){
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
    
    function step1_validation(element){
        if(element.parents('form').find('.datepicker').val()==''){
            element.parents('form').find('.datepicker').parent('.form-group').addClass('has-error');
            return false;
        }else{
            element.parents('form').find('.datepicker').parent('.form-group').removeClass('has-error');
            return true;
        }
    }
    
    function searchResults(){
        $('.loadover').show();
        data = $('#searchForm').serialize();
        jQuery.ajax({
                    type: 'POST',
                    url : '{{ route('ajax.search.submit') }}',
                    data: data,					
                    success : function(data){
                            $('.loadover').hide();
                            $('.response').html(data);
                            $(".content").mCustomScrollbar();
                    }
             });
    }
    
    
    google.maps.event.addDomListener(window, 'load', initialize);    
    function initialize() {
        var markers = '<?php  echo $markers; ?>';
        var latlng = new google.maps.LatLng(36.778259, -119.417931);
        var myOptions = {
            zoom: 5,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        };

        var map = new google.maps.Map(document.getElementById("map"),myOptions);
        var infowindow = new google.maps.InfoWindow(), marker, lat, lng;
        var json=JSON.parse( markers );

        for( var o in json ){

            lat = json[ o ].lat;
            lng=json[ o ].lng;
            name=json[ o ].name;

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat,lng),
                name:name,
                map: map
            }); 
            google.maps.event.addListener( marker, 'click', function(e){
                infowindow.setContent( this.name );
                infowindow.open( map, this );
            }.bind( marker ) );
        }
    }
   $(document).ready(function(){
     $(".fake-radio").on("click", function(){
      $(this).addClass("active").siblings().removeClass("active");
     })
   })
</script>
@stop