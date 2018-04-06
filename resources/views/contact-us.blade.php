@extends('master')
@section('title', 'Contact Us')
@section('body')
<style>
#newsletter{margin-top:0;}
</style>
<!-- Breadcrumb Heading -->
<div class="breadcrumb">
	<div class="data">
		<h1>
			Contact Us
		</h1>
		<ul>
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="javascript:void(0);">Contact Us</a></li>
		</ul>
	</div>
</div>
<!-- /Breadcrumb Heading -->

<!-- Contact Us Wrapper -->

<div class="col-sm-12 clmn">
	<div class="overlay-box">
		<span class="step-label">Drop us a Message</span>
		<div class="content">
                    
                    @if (count($errors))
                        @foreach($errors->all() as $error)
                            <div class="col-sm-12">
                                <div class="alert alert-success"> &nbsp; {{ $error }} </div>
                            </div>
                        @endforeach
                    @endif
                    
                    <form method="post" action="{{ route('submit.contact') }}">
                        {{ csrf_field() }}
				<div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                                <i class="fa fa-user flt-icon" aria-hidden="true"></i>
                                                <input type="text" class="form-control" required="" placeholder="Full Name" name="sender_name" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                                <i class="fa fa-at flt-icon" aria-hidden="true"></i>
                                                <input type="email" class="form-control" required="" placeholder="Email Address" name="sender_email" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                                <i class="fa fa-phone flt-icon" aria-hidden="true"></i>
                                                <input type="text" class="form-control" placeholder="Phone" name="sender_phone" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="" placeholder="Subject" name="subject" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="12" name="message" required="" cols="12" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 text-right">
                                        <input type="submit" class="btn btn-clrd" value="Send" />
                                    </div>
				</div>
			</form>
			
			
			<hr>
			<h3 class="section-heading">Our Location</h3>
			<div class="map">
                            <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                        </div>
                        
                        <!--
                        <hr>
			<p><strong>@Support <a style="color: #01bea0;" href="mailto:sales@rentersland.com">sales@rentersland.com</a></strong></p>
			<p><strong>@Admin <a style="color: #01bea0;" href="mailto:admin@rentersland.com">admin@rentersland.com</a></strong></p>
			<p><strong>@Inquiries <a style="color: #01bea0;" href="mailto:support@rentersland.com">support@rentersland.com</a></strong></p>
			<p><strong>@Other <a style="color: #01bea0;" href="mailto:max@rentersland.com">max@rentersland.com</a></strong></p>
                        -->
                        
                </div>
	</div>
</div>

<!-- /Contact Us Wrapper -->


@if($setting->lat == '')
    <?php $setting->lat = '37.2872357'; ?>
@endif
@if($setting->lng == '')
    <?php $setting->lng = '-121.9591312'; ?>
@endif

@stop

@section('script')

<script>

    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var latlng = new google.maps.LatLng('<?=$setting->lat?>','<?=$setting->lng?>');
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


</script>


@stop