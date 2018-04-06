<div class="row">
    <span class="step-label">Details</span>
    <div class="content">
        <div class="form-group col-sm-6">
                <label>Price</label>
                <input type="text" maxlength="6" class="form-control number reset" id="price"  placeholder="Price" name="price"  value="{{ isset($listing->price)?$listing->price:'' }}"/>
        </div>
        <div class="form-group col-sm-6">
            <label>Property Type <span class="text-danger">*</span></label>
            	<?php $property_type = isset($listing->property_type)?$listing->property_type:'';?>
                <select name="property_type" class="form-control">
                    <option value="Condo" label="Condo" @if($property_type=='Condo')  selected @endif>Condo</option>
                    <option value="Houseboat" label="Houseboat" @if($property_type=='Houseboat')  selected @endif>Houseboat</option>
                    <option value="Lot / Land" label="Lot / Land" @if($property_type=='Lot / Land')  selected @endif>Lot / Land</option>
                    <option value="Single Family Home" label="Single Family Home"  @if($property_type=='Single Family Home')  selected @endif>Single Family Home</option>
                    <option value="Co-op" label="Co-op" @if($property_type=='Co-op')  selected @endif>Co-op</option>
                    <option value="Floorplan" label="Floorplan" >Floorplan</option>
                    <option value="Room" label="Room" @if($property_type=='Room')  selected @endif>Room</option>
                    <option value="Townhouse" label="Townhouse" @if($property_type=='Townhouse')  selected @endif>Townhouse</option>
                    <option value="Apartment" label="Apartment" @if($property_type=='Apartment')  selected @endif>Apartment</option>
                    <option value="Loft" label="Loft" @if($property_type=='Loft')  selected @endif>Loft</option>
                    <option value="Mobile Manufactured" label="Mobile Manufactured" @if($property_type=='Mobile Manufactured')  selected @endif>Mobile Manufactured</option>
                    <option value="Farm / Ranch" label="Farm / Ranch" @if($property_type=='Farm / Ranch')  selected @endif>Farm / Ranch</option>
                    <option value="Multifamily" label="Multifamily" @if($property_type=='Multifamily')  selected @endif>Multifamily</option>
                </select>
        </div>
        <div class="form-group col-sm-6">
                <label>Square Feet</label>
                <input type="text" class="form-control number reset" placeholder="Square Feet" name="sqr_feet" value="{{ isset($listing->sqr_feet)?$listing->sqr_feet:'' }}"     />
        </div>
        <div class="form-group col-sm-6">
                <label>Bedrooms</label>
                <input type="number" step="1" min="1" max="20"  class="form-control number"  placeholder="Bedrooms" name="bedrooms"  value="{{ isset($listing->bedrooms)?$listing->bedrooms:'' }}" />
        </div>
        <div class="form-group col-sm-6">
                <label>Bathrooms</label>
                <input type="number" step="1" min="1" max="20"  class="form-control number" placeholder="Bathrooms" name="bathrooms"  value="{{ isset($listing->bathrooms)?$listing->bathrooms:'' }}" />
        </div>
        <div class="form-group col-sm-6">
                <label>Partial Bathrooms</label>
                <input type="number" step="1" min="1" max="20" class="form-control number" placeholder="Partial Bathrooms" name="partial_bathrooms"  value="{{ isset($listing->partial_bathrooms)?$listing->partial_bathrooms:'' }}" />
        </div>
        <div class="col-sm-6 pets">
            <label class="big" style="margin-right: 14px;">Pets:</label>
            
            <?php 
                $pets_array = array();
                $pets = isset($listing->pets)?$listing->pets:''; 
                if($pets!=''){
                    $pets_array = explode(',', $pets);
                    
                }
                
              ?>
            
                <div class="pretty p-image p-plain">
                    <input type="checkbox" name="pets[]" value="Cats" @if(in_array('Cats', $pets_array))  checked @endif />
                    <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
                      <label>Cats</label>
                    </div>
                </div>

                <div class="pretty p-image p-plain">
                    <input type="checkbox" name="pets[]" value="Dogs" @if(in_array('Dogs', $pets_array)) checked @endif />
                    <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
                      <label>Dogs</label>
                    </div>
                 </div>
        </div>
        <div class="col-sm-6 pets">
                <!----<label class="big" style="margin-right: 14px;">Leasing Fee:</label>

                <div class="pretty p-icon p-round">
                    <input type="radio" name="leasing_fees" value="yes" />
                    <div class="state p-success">
                        <i class="icon mdi mdi-check"></i>
                        <label>Yes</label>
                    </div>
                </div>

                <div class="pretty p-icon p-round">
                    <input type="radio" name="leasing_fees" value="no" />
                    <div class="state p-success">
                        <i class="icon mdi mdi-check"></i>
                        <label>No</label>
                    </div>
                </div>--->
        </div>
        <div class="form-group col-sm-12">
                <label>Description:</label>
                <textarea class="form-control" name="description" rows="8" cols="12" >{{ isset($listing->description)?$listing->description:'' }}</textarea>
        </div>

        <div class="form-group col-sm-12 text-right">
            <a href="javascript:void(0)" class="btn btn-red btn-back" curr="step2" prev="step1" next="step3">Back</a>
            <a href="javascript:void(0)" class="btn btn-clrd btn-next" curr="step2" prev="step1" next="step3">Next</a>
        </div>

    </div>
</div>