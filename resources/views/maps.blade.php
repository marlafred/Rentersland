<!DOCTYPE html>
<html>
<head>
<title>Autocomplete search address form using google map and get data into form example </title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRioriKo2PIVw_tADDisMP_pGK-CHwWq8&libraries=places"></script>
</head>
<body>
 <input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">
 <div class="map" id="map" style="width: 100%; height: 300px;"></div>
 <div class="form_area">
     <input type="text" name="location" id="location">
     <input type="text" name="lat" id="lat">
     <input type="text" name="lng" id="lng">
 </div>
<script>
/* script */
function initialize() {
   var latlng = new google.maps.LatLng(37.2681657,-121.9087564);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
   
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
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
            map.setZoom(17);
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
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
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
        
        console.log(postCode);
        console.log(street);
        console.log(town);
        console.log(country);
        
        //document.getElementById('location').value = address;
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
        
        document.getElementById('street_name').value = street;
        document.getElementById('city').value = town;
        document.getElementById('zipcode').value = postCode;
        
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

<style type="text/css">
    .input-controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchInput {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 50%;
    }
    #searchInput:focus {
      border-color: #4d90fe;
    }
</style>


</body>
</html>