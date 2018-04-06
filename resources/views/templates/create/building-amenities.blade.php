<?php 

$buildingamenties_array = array();

$custom_buildingamenties_array = array();

if(isset($listing->buildingamenties) and count($listing->buildingamenties) > 0){

  foreach($listing->buildingamenties as $buildingamenties){

    if($buildingamenties->name!=''){

      array_push($buildingamenties_array, $buildingamenties->name);



      $new_buildingamenties_array = explode('||', $buildingamenties->name);

      if(is_array($new_buildingamenties_array) && !isset($new_buildingamenties_array[1])){

       array_push($custom_buildingamenties_array, $buildingamenties->name);

     }



   }

 }

}

?>

<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="business center||icon-business-center" @if(in_array('business center||icon-business-center', $buildingamenties_array)) checked @endif />

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>business center</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Concierge Service||icon-concierge" @if(in_array('Concierge Service||icon-concierge', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="https://lokesh-coder.github.io/pretty-checkbox/img/checked/004.png">

    <label>Concierge Service</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Door Person||icon-door-person" @if(in_array('Door Person||icon-door-person', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Door Person</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Dry Cleaning||icon-dry-clean" @if(in_array('Dry Cleaning||icon-dry-clean', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Dry Cleaning</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Elevator||icon-elevator" @if(in_array('Elevator||icon-elevator', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Elevator</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Fitness Center||icon-fitness-cluc" @if(in_array('Fitness Center||icon-fitness-cluc', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Fitness Center</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Garage Parking||icon-garage-parking" @if(in_array('Garage Parking||icon-garage-parking', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Garage Parking</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="On Site Laundry||icon-laundry" @if(in_array('On Site Laundry||icon-laundry', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>On Site Laundry</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Onsite Management||icon-management" @if(in_array('Onsite Management||icon-management', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Onsite Management</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Outdoor Space||icon-outdoor-space" @if(in_array('Outdoor Space||icon-outdoor-space', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Outdoor Space </label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Residents' Lounge||icon-lounge" @if(in_array("Residents' Lounge||icon-lounge", $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Residents' Lounge</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Roof Deck||icon-roof-deck" @if(in_array('Roof Deck||icon-roof-deck', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Roof Deck</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Secured Entry||icon-secured-entry" @if(in_array('Secured Entry||icon-secured-entry', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Secured Entry</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Storage||icon-storage" @if(in_array('Storage||icon-storage', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Storage</label>

  </div>

</div>



<div class="pretty p-image p-plain">

  <input type="checkbox" name="building_amenties[]" value="Wheelchair Access||icon-wheel-chair" @if(in_array('Wheelchair Access||icon-wheel-chair', $buildingamenties_array)) checked @endif/>

  <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">

    <label>Wheelchair Access</label>

  </div>

</div>



<div class="clearfix"></div>

<div class="old_amentiy_div">
  <div class="row">
    <?php foreach($custom_buildingamenties_array as $custom_buildingamenties_val){?>
    <div class="amen_wrapper col-sm-6">
      <input type="text" maxlength="18" name="building_amenties[]" class="form-control" value="<?php echo $custom_buildingamenties_val;?>" />
      <button type="button" class="btn-red remove_this_amenity"><i class="fa fa-remove"></i></button>
    </div>
    <?php } ?>
  </div>
</div>

<div class="clearfix"></div>

<div class="new_building_amenties" style="border: 1px solid #e5e5e5; padding: 2%;">

  <h4>Add New Building Amenities</h4>

  <div class="row">

    <div class="col-sm-6">

      <input type="text" maxlength="18" name="building_amenties[]" class="form-control" />



    </div>

    <div class="col-sm-6">

      <button type="button" id="add_new_building_amenity" class="btn-success"><i class="fa fa-plus-circle"></i></button>

    </div>

    <div class="clearfix"></div>

    <div class="new_building_amenty"></div>

    <div class="clearfix"></div>

  </div>



</div>      

<br>

<div class="clearfix"></div>



<div class="new_building_amentiy_div" style="display: none;">

  <div class="amen_wrapper">

    <div class="col-sm-6">

      <input type="text" maxlength="18" name="building_amenties[]" class="form-control" />

    </div>

    <div class="col-sm-6">

      <button type="button" class="btn-red remove_this_amenity"><i class="fa fa-remove"></i></button>

    </div>

    <div class="clearfix"></div>

  </div>

</div>

