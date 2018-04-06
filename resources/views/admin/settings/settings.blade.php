@extends('adminlte::page')
@section('title', 'Settings')
@section('content')

<section style="padding: 0 6%;">
    <div class="row">
        <div class="col-md-3">
            @include('admin.settings.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-cog"></i> Genral Settings </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                
                    <form id="genral_settings" onsubmit="return false;">
                    {{ csrf_field() }}
                    <div class="col-sm-6 form-group">
                        <label>Site Title</label>
                        <input type="text" class="form-control" name="title" value="{{ isset($setting->title)?$setting->title:'' }}">
                    </div><!--col-sm-6-->
                    <div class="col-sm-6 form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" name="email" value="{{ isset($setting->email)?$setting->email:'' }}">
                        <p class="text-musted" style="margin-bottom: 0px;"> This Email will be used to send emails.</p>
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>

                    <div class="col-sm-6 form-group">
                        <label>Contact Number</label>
                        <input type="text" class="form-control" name="contact" value="{{ isset($setting->contact)?$setting->contact:'' }}">
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>
                    
                    
                    <div class="col-sm-6 form-group">
                        <label>Site Logo (220px * 60px)</label>
                        <input type="file" id="logo"  name="logo"  accept="image/*" class="btn btn-default" />
                    </div><!--col-sm-6-->
                    <div class="col-sm-6 form-group">
                        @if(isset($setting->logo) and $setting->logo!='')
                            <img src="{{ asset('static/') }}/{{ $setting->logo }}" style="width:219px; height: 54px;">
                            <input type="hidden" name="logo_image" value="{{ $setting->logo }}">
                        @endif
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-6 form-group">
                        <label>Logo Position</label>
                        <?php $position = isset($setting->logo_position)?$setting->logo_position:''; ?>
                        <select id="logo_position"  name="logo_position"  class="form-control">
                            <option value="left" <?php if($position=='left'){ echo 'selected'; } ?>>Left Align</option>
                            <option value="center" <?php if($position=='center'){ echo 'selected'; } ?> >Center Align</option>
                            <option value="right" <?php if($position=='right'){ echo 'selected'; } ?> >Right Align</option>
                        </select>
                    </div><!--col-sm-6-->
                    <div class="col-sm-6 form-group">
                        
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-12 form-group">
                        <h3 class="box-title text-info" style="font-size: 18px;"><i class="fa fa-map"></i> Our Location </h3>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 North East CA, United States" value="{{ isset($setting->address)?$setting->address:'' }}">
                    </div><!--col-sm-6-->
                    
                    <div class="col-sm-6 form-group">
                        <label>Lattitude</label>
                        <input type="text" readonly="" class="form-control" id="lat" name="lat" value="{{ isset($setting->lat)?$setting->lat:'' }}">
                    </div><!--col-sm-6-->
                    
                    <div class="col-sm-6 form-group">
                        <label>Longitude</label>
                        <input type="text" readonly=""  class="form-control" id="lng" name="lng" value="{{ isset($setting->lng)?$setting->lng:'' }}">
                    </div><!--col-sm-6-->
                    
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-12 form-group">
                        <h3 class="box-title text-danger" style="font-size: 18px;"><i class="fa fa-google-wallet"></i> Social Settings</h3>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="facebook" value="{{ isset($setting->facebook)?$setting->facebook:'' }}">
                    </div><!--col-sm-6-->
                    <div class="col-sm-6 form-group">
                        <label>Twitter</label>
                        <input type="text" class="form-control" name="twitter" value="{{ isset($setting->twitter)?$setting->twitter:'' }}">
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>

                    <div class="col-sm-6 form-group">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="instagram" value="{{ isset($setting->instagram)?$setting->instagram:'' }}">
                    </div><!--col-sm-6-->
                    <div class="col-sm-6 form-group">
                        <label>Google Plus</label>
                        <input type="text" class="form-control" name="google_plus" value="{{ isset($setting->google_plus)?$setting->google_plus:'' }}">
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-12 form-group">
                        <label><i class="fa fa-copyright"></i> &nbsp; Copyright</label>
                        <input type="text" class="form-control" name="copyright" value="{{ isset($setting->copyright)?$setting->copyright:'' }}">
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>

                    <div class="col-sm-6 form-group">
                        <br>
                        <div class="response">&nbsp;</div>
                    </div><!--col-sm-6-->
                    <div class="col-sm-6 form-group text-right">
                        <label></label>
                        <input type="submit" class="btn btn-success" value="Save Settings">
                    </div><!--col-sm-6-->
                    <div class="clearfix"></div>

                    </form>
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop

@section('js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRioriKo2PIVw_tADDisMP_pGK-CHwWq8&libraries=places&region=GB"></script>
     <script>
    /* script */
    function initialize() {
       
        var input = document.getElementById('address');
        var geocoder = new google.maps.Geocoder();
        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();   
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
           
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng(), place.address_components);
            infowindow.setContent(place.formatted_address);
          

        });
        
       
    }
    function bindDataToForm(address,lat,lng, address_components){
       if(address_components){

            
            var town = extractFromAdress(address_components, "locality");
            var state = extractFromAdress(address_components, "administrative_area_level_1");
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

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
<script type="text/javascript">
    $(document).ready(function() {
        /**
            Save Template data
      **/
      $('#genral_settings').on('submit', function(e){
            var data =  $(this).serialize();
            var element = $(this);
            $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
            $('.cd-popup-trigger').click();

            $.ajax({
                type:"POST",
                url:"{{ route('submit.settings') }}",
                data: new FormData($('#genral_settings')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data){
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
                },error: function(){
                        setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                         },1000);
                }
            });

        });
    });
    
</script>
@stop