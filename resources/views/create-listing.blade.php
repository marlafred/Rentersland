@extends('master')
@section('title', 'Create Listing')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Create Listing</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('listings') }}">listings</a></li>
            <li class="active"><a href="javascript:void(0);">create</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
    <form id="listing_form">
        @include('templates.create.sidebar')
        
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <div class="overlay-box step1">
            @include('templates.create.step1')
        </div><!--step-1-->

        <div class="overlay-box step2">
            @include('templates.create.step2')
        </div><!--step-2-->

        <div class="overlay-box step3">
            <div class="row">
                <span class="step-label">Amenities</span>
                <div class="content">
            
                    <div class="col-sm-12">
                        <h3 class="c-heading">Amenities</h3>
                        @include('templates.create.amenities')
                        
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <h3 class="c-heading">Building Amenities</h3>
                        @include('templates.create.building-amenities')
                    </div>
                    <hr>
                    <!--<div class="form-group col-sm-12">
                        <h3 class="c-heading">Terms</h3>
                        <textarea name="lease_terms" class="form-control" rows="5" placeholder="Lease Terms"></textarea>
                    </div>-->
                    
                    <div class="form-group col-sm-12 text-right">
                        <a href="javascript:void(0)" class="btn btn-red btn-back" curr="step3" prev="step2" next="step4">Back</a>
                        <a href="javascript:void(0)" class="btn btn-clrd btn-next" curr="step3" prev="step2" next="step4">Next</a>                    </div>
           
                </div>
            </div>
        </div><!--step-3-->
        
        <div class="overlay-box step4">
            @include('templates.create.contact')
        </div><!--step-4-->
        
        <div class="overlay-box step5">
            
            @include('templates.create.photos')
            <div class="form-group col-sm-12 text-right">
                <a href="javascript:void(0);" class="btn btn-red btn-back" curr="step5" prev="step4" next="">Back</a>
                <a href="javascript:void(0)" class="btn btn-success" id="submit_listing" curr="step5" prev="step4" next="">Done</a>
            </div>
        </div><!--step-5-->
        
        <input type="hidden" value="{{ isset($listing->id)?$listing->id:'' }}" name="id" />
        
    </form>
</div>
@stop

@section('script')
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">
<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/exif.js') }}"></script>
<script>
    $(document).ready(function(){
        
        $('.remove_img').on('click', function(e){
            $(this).parents('.col-sm-4').remove();
        });
        
        $('.overlay-box').hide();
        $('.step1').show();
        
        $('.btn-next').on('click', function(e){
            var flag = true;
           
            var next = $(this).attr('next');
            
            if(next=='step2'){
               if(step1_validation()){
                   flag = true;
               }else{
                   flag = false;
                   $('.overlay-box').hide();
                   $('.step1').show();
               }
            }else if(next=='step3'){
               if(step2_validation()){
                   flag = true;
               }else{
                   flag = false; 
               }
            }
            
            if(flag){
                 $('.overlay-box').hide();
                $('.'+next).show();
                $('.steps-nav li').removeClass('current');
                $('.'+next).addClass('active current');
                $('html, body').animate({ 
                    scrollTop: $('div.'+next).offset().top
                });
            }else{
                curr = $(this).attr('curr');
                $('.'+curr).show();
                $('html, body').animate({ 
                    scrollTop: $('div.'+curr).offset().top
                });
            }
        });
        
        $('.btn-back').on('click', function(e){
            $('.overlay-box').hide();
            var prev = $(this).attr('prev');
            $('.'+prev).show();
            $('.steps-nav li').removeClass('current');
            $('.'+prev).removeClass('active');
            $('.'+prev).addClass('active current');
            $('html, body').animate({ 
                scrollTop: $('div.'+prev).offset().top
            });
        });
        
        $('.steps-nav li a').on('click', function(){
            $('.overlay-box').hide();
            var step = $(this).attr('step');
            
            $('.'+step).show();
            $('.steps-nav li').removeClass('current');
            $('.'+step).addClass('active current');
            $('html, body').animate({ 
                scrollTop: $('div.'+step).offset().top
            });
        });
        
        
        $('#add_new_amenity').on('click', function(e){
            $('.new_amenty').append($('.new_amentiy_div').html());
        });
        
        $('#add_new_building_amenity').on('click', function(e){
            $('.new_building_amenty').append($('.new_building_amentiy_div').html());
        });
        
        $(document).on('click','.remove_this_amenity', function(e){
            $(this).parents('.amen_wrapper').remove();
        });
        
    });
    
    $(function () {
        $('#schedual_startdate').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
        });
        $('#schedual_enddate').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,

        });
    });
    
   	  
    Dropzone.autoDiscover = false;
    token = $('meta[name="csrf-token"]').attr('content');
        //$(".dropzone").css('background-image',"url('{{ asset('images/spritemap.png') }}')");
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
        autoProcessQueue: false,
        url: "{{ route('dropzone.uploads') }}",
        params: {
            _token: token
        }

    });
    
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        //maxFilesize: 2, // MB
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        accept: function(file, done) {

        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
    };

    myDropzone.on("success", function(file,response) {
        console.log(response);
        filename = response+'#';						  						  
        $("#upload_images").append(filename);
        $('#submit_listing').click();	
        if(response.html==undefined || response.html==null) {

        }	
    });

    $(document).ready(function(e) {
       	$('#submit_listing').on('click', function(e){
            flag = true;
            if(step1_validation()){
                flag = true;
            }else{
               flag = false;
               $('.step1').show();
               $('div.step5').hide();
            }
            if(flag){
                if(step2_validation()){
                    flag = true;
                }else{
                   flag = false; 
                   $('.step2').show();
                   $('div.step5').hide();
                }
            }
            
            if(flag){
                $('.step5').show();
            }else{
                return false;
            }
                 
	    var uploaded1 = 0;

            var attachments1 =	$('#upload_images').html();
            var res = attachments1.split("#");
            uploaded1 = res.length-1;

            uploaded1 = myDropzone.getQueuedFiles().length + uploaded1;

            if(myDropzone.getQueuedFiles().length > 20){
                alert("Maximum 20 files can be uploaded!");
                return false;		
            }
            
            if(uploaded1 < 21){
                if (myDropzone.getQueuedFiles().length > 0) { 
                        $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                        $('.cd-popup-trigger').click();
                        myDropzone.processQueue();  
                }else {
                   var attachments =	$('#upload_images').html();
                        var attchment_len =	$.trim( attachments ).length;

                        var uploaded = 0;

                        if(attchment_len>0){
                                var res = attachments.split("#");
                                uploaded = res.length-1;
                                div_length = $(".dz-preview").length;

                                if(uploaded==div_length || uploaded>div_length){
                                        submit_ad();		
                                }
                        }else{

                                submit_ad();
                        }
                }
            }else{
                alert("Maximum 5 files can be uploaded!");
                return false;		
            }
        });
    
    });
    
    function submit_ad(){
        
        $('.ad_images').val($('#upload_images').html());	
	$('.dz-remove').hide();
        if($('.ad_images').val()==''){
           if(!confirm("Listing images not found, should continue without images ??")){
               return false;
           }
        }
     
        base_url = $('#base_url').val();
        $.ajax({
            type:"POST",
            url:"{{ route('submit.listings') }}",
            data: new FormData($('#listing_form')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    setTimeout(function(){  
                        $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Added Successfully..!!</span>');
                    },1000);
                    window.location.href  = base_url+"/listing/detail/"+obj.slug;
                }else{
                   $('.cd-popup-container').find('p').html('<span class="text-red"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                } 
            }
            
        });//ajax
        
        
    }
    
    function step1_validation(){
       var flag = true;
       
       if($('#title').val()==''){
           $('#title').parent('.form-group').addClass('has-error');
           flag = false;
       }else{
           $('#title').parent('.form-group').removeClass('has-error');
       }
       
       if($('#searchAddress').val()==''){
           $('#searchAddress').parent('.form-group').addClass('has-error');
           flag = false;
       }else{
           $('#searchAddress').parent('.form-group').removeClass('has-error');
       }
       
       if($('#country').val()!='United States' || $('#state').val()==''){
           $('#searchAddress').parent('.form-group').addClass('has-error');
           flag = false;
          
       }else{
           $('#searchAddress').parent('.form-group').removeClass('has-error');
       }
       
       if($('#street_name').val()==''){
           $('#street_name').parent('.form-group').addClass('has-error');
           flag = false;
           
       }else{
           $('#street_name').parent('.form-group').removeClass('has-error');
       }
       
       if($('#city').val()==''){
           $('#city').parent('.form-group').addClass('has-error');
           flag = false;
           
       }else{
           $('#city').parent('.form-group').removeClass('has-error');
       }
       
       if($('#zipcode').val()==''){
           $('#zipcode').parent('.form-group').addClass('has-error');
           flag = false;
           
       }else{
           $('#zipcode').parent('.form-group').removeClass('has-error');
       }
       return flag;
    }
    
    function step2_validation(){
        var flag = true;
        if($('#price').val()==''){
           $('#price').parent('.form-group').addClass('has-error');
           flag = false;
        }else{
           $('#price').parent('.form-group').removeClass('has-error');
        }
        
        return flag;
    }
    
</script>

<script>
/* script */
function initialize() {
   var latlng = new google.maps.LatLng(36.778259, -119.417931);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 7
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, 10)
   });
   
    var input = document.getElementById('searchAddress');
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(10);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng(), place.address_components);
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) { 
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng(), results[0].address_components);
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng, address_components){
   if(address_components){
   
        var postCode = extractFromAdress(address_components, "postal_code");
        var street = extractFromAdress(address_components, "route");
        var town = extractFromAdress(address_components, "locality");
        var country = extractFromAdress(address_components, "country");
        var state = extractFromAdress(address_components, "administrative_area_level_1");
        
        if(state){
            document.getElementById('searchAddress').value = address;
            document.getElementById('street_name').value = street;
            document.getElementById('zipcode').value = postCode;
            document.getElementById('city').value = town;

            //Hidden fields
            document.getElementById('country').value = country;
            document.getElementById('state').value = state;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        }
     
    }
}
google.maps.event.addDomListener(window, 'load', initialize);


function extractFromAdress(components, type){
    for (var i=0; i<components.length; i++)
        for (var j=0; j<components[i].types.length; j++)
            if (components[i].types[j]==type) return components[i].long_name;
    return "";
}


</script>

@stop