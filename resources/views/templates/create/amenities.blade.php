<?php 

$amen_array = array();

$custom_amen_array = array();

if(isset($listing->amenities) and count($listing->amenities) > 0){

  foreach($listing->amenities as $amenties){

    if($amenties->name!=''){

      array_push($amen_array, $amenties->name);



      $new_amen_array = explode('||', $amenties->name);

      if(is_array($new_amen_array) && !isset($new_amen_array[1])){

       array_push($custom_amen_array, $amenties->name);

     }



   }

 }

}

?>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="air conditioning||icon-air-conditioner" @if(in_array('air conditioning||icon-air-conditioner', $amen_array)) checked @endif />

  

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>air conditioning</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="assigned parking||icon-garage-parking" @if(in_array('assigned parking||icon-garage-parking', $amen_array)) checked @endif />

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>assigned parking</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="balcony||icon-balcony" @if(in_array('balcony||icon-balcony', $amen_array)) checked @endif />

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>balcony</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="carpet||icon-carpet" @if(in_array('carpet||icon-carpet', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>carpet</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="ceiling fan||icon-ceiling-fan" @if(in_array('ceiling fan||icon-ceiling-fan', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>ceiling fan</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="central heat||icon-central-heating" @if(in_array('central heat||icon-central-heating', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>central heat</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="deck||icon-roof-deck" @if(in_array('deck||icon-roof-deck', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>deck</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="dishwasher||icon-dishwasher" @if(in_array('dishwasher||icon-dishwasher', $amen_array)) checked @endif />

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>dishwasher</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="fireplace||icon-fireplace" @if(in_array('fireplace||icon-fireplace', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>fireplace</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="furnished||icon-furnished" @if(in_array('furnished||icon-furnished', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>furnished</label>

  </div>

</div>





<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="garden||icon-garden" @if(in_array('garden||icon-garden', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>garden</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="hardwood floor||icon-floor" @if(in_array('hardwood floor||icon-floor', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>hardwood floor</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="high ceilings||icon-ceiling" @if(in_array('high ceilings||icon-ceiling', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>high ceilings</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="in unit laundry||icon-laundry" @if(in_array('in unit laundry||icon-laundry', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>in unit laundry</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="on site laundry||icon-laundry" @if(in_array('on site laundry||icon-laundry', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>on site laundry</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="amenities[]" value="walk in closet||icon-closet" @if(in_array('walk in closet||icon-closet', $amen_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>walk in closet</label>

  </div>

</div>



<div class="clearfix"></div>



<div class="old_amentiy_div">
  <div class="row">

    <?php foreach($custom_amen_array as $custom_amen_val){?>

    <div class="amen_wrapper col-sm-6">
      <input type="text" maxlength="18" name="amenities[]" class="form-control" value="<?php echo $custom_amen_val;?>" />
      <button type="button" class="btn-red remove_this_amenity"><i class="fa fa-remove"></i></button>
    </div>

    <?php } ?>

  </div>
</div>

<div class="clearfix"></div>

<div class="new_amenties" style="border: 1px solid #e5e5e5; padding: 2%;">

  <h4>Add New Amenities</h4>

  <div class="row">

    <div class="col-sm-6">

      <input type="text" maxlength="18" name="amenities[]" class="form-control" />



    </div>

    <div class="col-sm-6">

      <button type="button" id="add_new_amenity" class="btn-success"><i class="fa fa-plus-circle"></i></button>

    </div>

    <div class="clearfix"></div>

    <div class="new_amenty"></div>

    <div class="clearfix"></div>

  </div>



</div>      

<br>

<div class="clearfix"></div>



<div class="new_amentiy_div" style="display: none;">

  <div class="amen_wrapper">

    <div class="col-sm-6">

      <input type="text" maxlength="18" name="amenities[]" class="form-control" />

    </div>

    <div class="col-sm-6">

      <button type="button" class="btn-red remove_this_amenity"><i class="fa fa-remove"></i></button>

    </div>

    <div class="clearfix"></div>

  </div>

</div>