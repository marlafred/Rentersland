<div class="row">
<div class="col-sm-12 sepbox">
    <h3 class="c-heading">Detail</h3>
    <ul class="detail_affix">
        <li><i class="fa fa-crosshairs" aria-hidden="true"></i> {{ $listing->sqr_feet }} SQFT</li>
        <li><i class="fa fa-bed" aria-hidden="true"></i> {{ $listing->bedrooms }} Bedroom</li>
        <li><i class="fa fa-bath" aria-hidden="true"></i> {{ $listing->bathrooms }} Bath</li>
    </ul>
</div>

<div class="col-sm-12 sepbox">
    <h3 class="c-heading">Summary</h3>
    {{$listing->description}}
</div>

<div class="col-sm-12 sepbox">
    <h3 class="c-heading"> Amenities</h3>
    @if($listing->amenities)
    <ul class="detail_affix">
        @foreach($listing->amenities as $amenties)
        <?php $name = explode('||', $amenties->name); $amenName = $name[0]; $icon = 'icon-concierge'; if(isset($name[1])){ $icon = $name[1]; }  ?>
        @if($amenName!='')
        <li><i class="icon {{ $icon }}" aria-hidden="true"></i> {{ $amenName }}</li>
        @endif
        @endforeach
    </ul>
    @endif
    
</div>

<div class="col-sm-12 sepbox">
    <h3 class="c-heading">Building Amenities</h3>
    
    @if($listing->buildingamenties)
    <ul class="detail_affix">
        @foreach($listing->buildingamenties as $amenties)
        <?php $name = explode('||', $amenties->name); $amenName = $name[0]; $icon = 'icon-concierge'; if(isset($name[1])){ $icon = $name[1]; }  ?>
        @if($amenName!='')
        <li><i class="icon {{ $icon }}" aria-hidden="true"></i> {{ $amenName }}</li>
        @endif
        @endforeach
    </ul>
    @endif
    
</div>

<div class="col-sm-12 sepbox">
    <h3 class="c-heading">District Location</h3>
    
    <div class="row">
        <div class="col-sm-6">
            <label>Address</label>
            <p> {{ $listing->address }}</p>
        </div><!--col-sm-6-->
        
        <div class="col-sm-6">
            <label>City/Town</label>
            <p> {{ $listing->city }}</p>
        </div><!--col-sm-6-->
        <div class="clearfix"></div>
        
        <div class="col-sm-6">
            <label>Street Name</label>
            <p> {{ $listing->street_name }}</p>
        </div><!--col-sm-6-->
        
        <div class="col-sm-6">
            <label>Street No.</label>
            <p> {{ $listing->street_no }}</p>
        </div><!--col-sm-6-->
        
    </div><!--row-->
    
</div>





<div class="sepbox col-sm-12">
        <h3 class="c-heading">Maps</h3>
        <div class="map">
            <div class="map" id="map" style="width: 100%; height: 300px;"></div>
        </div>
</div>
</div>
                