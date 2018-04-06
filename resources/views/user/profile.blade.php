@extends('master')

@section('title', 'Update Profile')

@section('body')

@if(Auth::user()->user_type=='Tenant')
@include('user.rental-sidebar')
@else
@include('user.sidebar')
@endif
<!-- Content Area -->
<div class="col-sm-6 dash-content">
    
    <div class="alert-box">
        <h4 class="heading"> <b>Edit Profile</b> </h4>
    </div>
    <div class="row edit-profile" style="margin-top: 30px;">

        @if (count($errors))
        @foreach($errors->all() as $error)
        <div class="text-danger">{{ $error }}</div>
        @endforeach
        @endif
        @if(session('success'))
        <div class="alert alert-success"><i class="fa fa-thumbs-up"></i> {{session('success')}}</div>
        @endif

        <form method="POST" action="{{ route('user.update.profile') }}">
            {{ csrf_field() }}
            <div class="form-group col-sm-6">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label>First Name</label>
                    <input id="first_name" type="text" placeholder="First Name *" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" required autofocus>
                </div>
            </div>

            <div class="form-group col-sm-6">
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label>Last Name</label>
                    <input id="last_name" type="text" placeholder="Last Name *" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" required>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group col-sm-6">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Email Address</label>
                    <input id="email" type="email" placeholder="Email Address *" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly="">
                </div>
            </div>

            <div class="form-group col-sm-6">
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label>Username</label>
                    <input id="username" type="text" placeholder="Username *" class="form-control" name="username" value="{{ Auth::user()->username }}" readonly="">
                </div>
            </div>
            <div class="clearfix"></div>    

            <div class="form-group col-sm-6">
                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    <label>Phone Number</label>
                    <input id="phone_number" type="text" placeholder="Phone Number" class="form-control" name="phone_number" value="{{ Auth::user()->phone_number }}">
                </div>
            </div>
            
            @if(Auth::user()->user_type=='Tenant')
                <?php 
                    $towns = array();
                    if(Auth::user()->towns!=''){
                        $towns = explode(',',Auth::user()->towns);
                    }
                    
                 ?>
            
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('towns') ? ' has-error' : '' }}">
                        <label>Town Interested</label>
                        <select id="towns" class="form-control" name="towns[]" multiple>
                                @if(count($states) > 0)
                                @foreach($states as $state)
                                        <option value="{{ $state->town }}" @if(in_array($state->town, $towns)) selected @endif >{{ $state->town }}</option>
                                @endforeach
                                @endif
                        </select>

                        @if ($errors->has('towns'))
                                <span class="help-block">
                                <strong>{{ $errors->first('towns') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
					
					
                <div class="clearfix"></div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('bedrooms') ? ' has-error' : '' }}">
                        
                            <select id="bedrooms" required class="form-control" name="bedrooms" value="{{ old('bedrooms') }}">
                                <option value="">Select Bedroom Option</option>                                    
                                <option value="1" @if(Auth::user()->bedrooms == '1') selected @endif >1+</option>
                                <option value="2" @if(Auth::user()->bedrooms == '2') selected @endif >2+</option>
                                <option value="3" @if(Auth::user()->bedrooms == '3') selected @endif >3+</option>
                                <option value="4" @if(Auth::user()->bedrooms == '4') selected @endif >4+</option>
                                <option value="5" @if(Auth::user()->bedrooms == '5') selected @endif >5+</option>
                                <option value="6" @if(Auth::user()->bedrooms == '6') selected @endif >6+</option>
                                <option value="7" @if(Auth::user()->bedrooms == '7') selected @endif >7+</option>
                                <option value="8" @if(Auth::user()->bedrooms == '8') selected @endif >8+</option>
                                <option value="9" @if(Auth::user()->bedrooms == '9') selected @endif >9+</option>
                                <option value="10" @if(Auth::user()->bedrooms == '10') selected @endif >10+</option>
                            </select>

                            @if ($errors->has('bedrooms'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('bedrooms') }}</strong>
                            </span>
                            @endif
                    </div>
                </div>
					
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('pets') ? ' has-error' : '' }}">

                            <select class="form-control" required name="pets">
                                <option value="">Do you Have Pets ?</option>                                    
                                <option value="Yes" @if(Auth::user()->pets == 'Yes') selected @endif >Yes</option>
                                <option value="No" @if(Auth::user()->pets == 'No') selected @endif >No</option>
                            </select>
                    </div>
                </div>
                
                @else
                <div class="form-group col-sm-6">
                    <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                        <label>Company</label>
                        <input id="company" type="text" placeholder="Company/Organization (if any)" class="form-control" name="company" value="{{ Auth::user()->company }}">
                    </div>
                </div>
                <div class="clearfix"></div> 
            @endif
            
            <div class="form-group col-sm-12">
                <div class="form-group{{ $errors->has('personal_info') ? ' has-error' : '' }}">
                    <label>Personal Info</label>
                    <textarea style="resize: none;" class="form-control" name="personal_info" rows="5" placeholder="Something about you ..">{{ Auth::user()->personal_info }}</textarea>
                </div>
            </div>

            <div class="clearfix"></div> 

            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
            <input type="hidden" name="country" id="country">
            <input type="hidden" name="state" id="state">
            <input type="hidden" name="city" id="city">
            <input type="hidden" name="zipcode" id="zipcode">
            <input type="hidden" name="street_name" id="street_name">

            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                <div class="col-sm-8"></div>
                <div class="form-group col-sm-4 text-right">
                    <input type="submit" class="btn btn-clrd" name="submit" value="Update Now" />
                </div>
            </div>
            <div class="clearfix"></div> 


        </div>
        
        
    </div><!--dash-content-->

    <div class="col-sm-3 dash-content">
        <div class="form-group col-sm-12">
            <label>Address</label>
            <input type="text" class="form-control" placeholder="Address" id="searchAddress" value="{{ Auth::user()->address }}" name="address" />
        </div>
        <div class="form-group col-sm-12">
            <label>Map</label>
            <div class="map" id="map" style="width: 100%; height: 300px;"></div>
        </div> 
    </div>
</form>

@stop

@section('script')

<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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

<script>
        $(document).ready(function(){
            $('#towns').select2({ placeholder: "Select Interested Towns", });

        });
    </script> 


@stop

       