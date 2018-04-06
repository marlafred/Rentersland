<h3>Current Residence</h3>


<div class="col-sm-3">
    <label class="big" style="margin-right: 14px;">Housing Type:</label>
</div>
<div class="col-sm-9">
    <?php $curr_type = isset($residence->curr_housing_type)?$residence->curr_housing_type:''; ?>
    
    <div class="pretty p-image p-plain">
        <input type="radio" class="curr_housing_type" name="curr_housing_type" value="rented" @if($curr_type=='rented' || $curr_type=='') checked  @endif />
        <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
          <label>Rented</label>
        </div>
    </div>
    <div class="pretty p-image p-plain">
        <input type="radio" class="curr_housing_type" name="curr_housing_type" value="owned" @if($curr_type=='owned') checked  @endif />
        <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
          <label>Owned</label>
        </div>
     </div>
</div>
<div class="clearfix"></div>

<div class="form-group col-sm-8">
    <label>Address <span class="text-danger">*</span></label>
    <input type="text" class="form-control" required="" value="{{ isset($residence->curr_address)?$residence->curr_address:'' }}" placeholder="Current Address" id="curr_address" name="curr_address" />
</div>
<div class="form-group col-sm-4">
    <label>Move in Date</label>
    <input type="text" class="form-control" placeholder="Move in Date" id="curr_move_date" value="{{ isset($residence->curr_move_date)?$residence->curr_move_date:'' }}" name="curr_move_date" />
</div>


<div class="curr_rented">
    <div class="form-group col-sm-4">
        <label>Monthly Rent</label>
        <input type="text" class="form-control" placeholder="Monthly Rent" value="{{ isset($residence->curr_rent)?$residence->curr_rent:'' }}" id="curr_rent" name="curr_rent" />
    </div>
    <div class="form-group col-sm-4">
        <label>Landlord Name</label>
        <input type="text" class="form-control" placeholder="Landlord Name" id="curr_landlord_name" value="{{ isset($residence->curr_landlord_name)?$residence->curr_landlord_name:'' }}" name="curr_landlord_name" />
    </div>
    <div class="form-group col-sm-4">
        <label>Landlord Phone No.</label>
        <input type="text" class="form-control" placeholder="Landlord Phone" value="{{ isset($residence->curr_landlord_phone)?$residence->curr_landlord_phone:'' }}" id="curr_landlord_phone" name="curr_landlord_phone" />
    </div>
</div><!--curr_rented-->

<div class="form-group col-sm-12">
    <label>Reason For Leaving <span class="text-danger">*</span></label>
    <textarea class="form-control" required="" name="curr_leaving_reason" placeholder="Enter Reason Here" rows="3">{{ isset($residence->curr_leaving_reason)?$residence->curr_leaving_reason:'' }}</textarea>
</div>

<div class="clearfix"></div>

<h3>Previous Residence</h3>

<div class="col-sm-3">
    <label class="big" style="margin-right: 14px;">Housing Type:</label>
</div>
<div class="col-sm-9">
    <?php $prev_type = isset($residence->prev_housing_type)?$residence->prev_housing_type:''; ?>
    <div class="pretty p-image p-plain">
        <input type="radio" class="prev_housing_type" name="prev_housing_type" value="rented"  @if($prev_type=='rented' or $prev_type=='') checked  @endif />
        <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
          <label>Rented</label>
        </div>
    </div>

    <div class="pretty p-image p-plain">
        <input type="radio" class="prev_housing_type" name="prev_housing_type" value="owned" @if($prev_type=='owned') checked  @endif  />
        <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
          <label>Owned</label>
        </div>
    </div>

    <div class="pretty p-image p-plain">
        <input type="radio" class="prev_housing_type" name="prev_housing_type" value="none" @if($prev_type=='none') checked  @endif />
        <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
          <label>None</label>
        </div>
     </div>
</div>
<?php $style = ''; ?>
@if($prev_type=='none')
<?php $style = 'display:none;'; ?>
@endif

<div class="prev_address_wrapper" Style='{{ $style }}'>

    <div class="form-group col-sm-8">
        <label>Address</label>
        <input type="text" class="form-control" placeholder="Previous Address" value="{{ isset($residence->prev_address)?$residence->prev_address:'' }}" id="prev_address" name="prev_address" />
    </div>
    <div class="form-group col-sm-4">
        <label>Move in Date</label>
        <input type="text" class="form-control" placeholder="Move in Date" id="prev_move_date" value="{{ isset($residence->prev_move_date)?$residence->prev_move_date:'' }}" name="prev_move_date" />
    </div>

    <div class="prev_rented">
        <div class="form-group col-sm-4">
            <label>Monthly Rent</label>
            <input type="text" class="form-control" placeholder="Monthly Rent" id="prev_rent" value="{{ isset($residence->prev_rent)?$residence->prev_rent:'' }}" name="prev_rent" />
        </div>
        <div class="form-group col-sm-4">
            <label>Landlord Name</label>
            <input type="text" class="form-control" placeholder="Landlord Name" id="prev_landlord_name" value="{{ isset($residence->prev_landlord_name)?$residence->prev_landlord_name:'' }}" name="prev_landlord_name" />
        </div>
        <div class="form-group col-sm-4">
            <label>Landlord Phone No.</label>
            <input type="text" class="form-control" placeholder="Landlord Phone" id="prev_landlord_phone" name="prev_landlord_phone" value="{{ isset($residence->prev_landlord_phone)?$residence->prev_landlord_phone:'' }}" />
        </div>
    </div><!--prev_rented-->

    <div class="form-group col-sm-12">
        <label>Reason For Leaving</label>
        <textarea class="form-control" name="prev_leaving_reason" placeholder="Enter Reason Here" rows="3">{{ isset($residence->prev_leaving_reason)?$residence->prev_leaving_reason:'' }}</textarea>
    </div>

</div><!--prev_address-->

    