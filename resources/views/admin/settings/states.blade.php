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
                    <b><i class="fa fa-globe"></i> Main Navigation Towns </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                    
                    <div class="box">
                        <div class="box-header">
                            <form action="{{ route('admin.submit.states') }}">
                                {{ csrf_field() }}

                                <div class="col-sm-4">
                                    <label>Add New Town</label>
                                    <input type="text" id="search" class="form-control">
                                </div><!--col-sm-3-->

                                <div class="col-sm-3">
                                    <label>State Name</label>
                                    <input type="text" readonly="" class="form-control" name="state" value="{{ old('state') }}" id="state" required>

                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <label>Town Name</label>
                                    <input type="text" readonly="" class="form-control" name="town" value="{{ old('town') }}" id="town" required>

                                    @if (count($errors))
                                        @foreach($errors->all() as $error)
                                            <div class="text text-danger"> {{ $error }} </div>
                                        @endforeach
                                    @endif
                                </div><!--col-sm-3-->
                                <div class="col-sm-3">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary">
                                </div><!--col-sm-3-->

                            </form>
                        </div>
                    </div>
                    
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20" style="text-align:center;">Sr#</th>
                                <th>Town</th>
                                <th>State</th>
                                <th>Listings</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pos=1 ?>
                            @if($states)
                                @foreach ($states as $state)
                                <tr>
                                    <td><?php print $pos++ ?></td>
                                    <td>{{ $state->town }}</td>
                                    <td>{{ $state->state }}</td>
                                    <td><span class="badge">{{ $state->list_count }}</span></td>
                                    <td>
                                        <a href="javascript:void(0);" rel-id="{{ $state->id }}" class="text-danger delete-this">
                                                <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>

                                @endforeach
                            @endif
                        </tbody>
                    </table>
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
       
        var input = document.getElementById('search');
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
            if(state){
                document.getElementById('town').value = town;
                document.getElementById('state').value = state;
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
           $('.delete-this').on('click', function(e){
              var rel_id = $(this).attr('rel-id');
              token = $('meta[name="csrf-token"]').attr('content');
              if(confirm("Are you sure to delete this ??")){
                  $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                  $('.cd-popup-trigger').click();
                    $.ajax({
                        url: '{{ route("delete.state") }}',
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
           }); 
        });
    </script>
@stop

