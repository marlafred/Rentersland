{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
     <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.listings') }}">
            <div class="info-box">
              <span class="info-box-icon bg-purple"><i class="fa fa-newspaper-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Listings</span>
                <span class="info-box-number">{{ count($listings) }}</span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.users') }}">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"><?=$users?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.requests') }}">
            <div class="info-box">
              <span class="info-box-icon bg-gray"><i class="fa fa-tripadvisor"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tour Requests</span>
                <span class="info-box-number"><?=$requests?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->
      
      <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('admin.subscribers') }}">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-envelope"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Subscribers</span>
                <span class="info-box-number"><?=$subscribers?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </a>
      </div><!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

    </div><!-- /.row -->
    
    <div class="clearfix"></div>
    <!--Map -->
    <div class="row">
        <div class="col-sm-8">
            <h3>&nbsp; </h3>
            <div class="map" style="padding: 8px; border: 1px solid #ddd; background: #FFF;">
                <div class="map" id="map" style="width: 100%; height: 400px;"></div>
            </div>
            
        </div>
        
        <div class="col-sm-4" style="background-color: #FFF; margin-top: 4.3%;">
            <h3><i class="fa fa-globe"></i> States Listings </h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Town</th>
                        <th>State</th>
                        <th>Listings</th>
                    </tr>
                </thead>
                <tbody>
                    @if($states)
                        @foreach ($states as $state)
                        <tr>
                           <td>{{ $state->town }}</td>
                           <td>{{ $state->state }}</td>
                           <td><span class="badge">{{ $state->list_count }}</span></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    <?php $locations=array(); $count= 1; ?>
    @if($listings)
        @foreach ($listings as $list)
            @if($list->lat!='')
                <?php $locations[]=array( 'name'=>$list->address, 'lat'=>$list->lat, 'lng'=>$list->lng ); ?>
                <?php $count++; ?>
            @endif
        @endforeach
        <?php $markers = json_encode( $locations ); ?>
    @endif
@stop

@section('css')
   <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRioriKo2PIVw_tADDisMP_pGK-CHwWq8&libraries=places&region=GB"></script>
   <script>
        google.maps.event.addDomListener(window, 'load', initialize);    
        function initialize() {
            var markers = '<?php  echo $markers; ?>';
            var latlng = new google.maps.LatLng(40.730610, -73.935242);
            var myOptions = {
                zoom: 3,
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
   </script>
@stop
