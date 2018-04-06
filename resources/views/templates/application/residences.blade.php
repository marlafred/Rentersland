<h3>Current Residence</h3>
<div class="col-sm-4">
    <label class="big" style="margin-right: 14px;">Housing Type:</label>
    <p class="">{{ isset($residence->curr_housing_type)?$residence->curr_housing_type:'' }} </p>
</div>
<div class="col-sm-4">
    <label>Address</label>
    <p class="">{{ isset($residence->curr_address)?$residence->curr_address:'' }}</p>
</div>
<div class="col-sm-4">
    <label>Move in Date</label>
    <p class="">{{ isset($residence->curr_move_date)?$residence->curr_move_date:'' }}</p>
</div>
<div class="clearfix"></div>

<div class="curr_rented">
    <div class="form-group col-sm-4">
        <label>Monthly Rent</label>
        <p class="">{{ isset($residence->curr_rent)?$residence->curr_rent:'' }}</p>
    </div>
    <div class="form-group col-sm-4">
        <label>Landlord Name</label>
        <p class="">{{ isset($residence->curr_landlord_name)?$residence->curr_landlord_name:'' }}</p>
    </div>
    <div class="form-group col-sm-4">
        <label>Landlord Phone No.</label>
        <p class="">{{ isset($residence->curr_landlord_phone)?$residence->curr_landlord_phone:'' }}</p>
    </div>
</div><!--curr_rented-->

<div class="form-group col-sm-12">
    <label>Reason For Leaving</label>
    <p class="">{{ isset($residence->curr_leaving_reason)?$residence->curr_leaving_reason:'' }}</p>
</div>

<div class="clearfix"></div>

<h3>Previous Residence</h3>

<div class="col-sm-4">
    <label class="big" style="margin-right: 14px;">Housing Type:</label>
    <p class=""> {{ isset($residence->prev_housing_type)?$residence->prev_housing_type:'' }} </p>
</div>
<div class="col-sm-4">
    <label>Address</label>
    <p class="">{{ isset($residence->prev_address)?$residence->prev_address:'' }}</p>
</div>
<div class="col-sm-4">
    <label>Move in Date</label>
    <p class="">{{ isset($residence->prev_move_date)?$residence->prev_move_date:'' }}</p>
</div>
<div class="clearfix"></div>
<div class="prev_address_wrapper">

    <div class="prev_rented">
        <div class="form-group col-sm-4">
            <label>Monthly Rent</label>
            <p class="">{{ isset($residence->prev_rent)?$residence->prev_rent:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Landlord Name</label>
            <p class="">{{ isset($residence->prev_landlord_name)?$residence->prev_landlord_name:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Landlord Phone No.</label>
            <p class="">{{ isset($residence->prev_landlord_phone)?$residence->prev_landlord_phone:'' }}</p>
        </div>
    </div><!--prev_rented-->

    <div class="form-group col-sm-12">
        <label>Reason For Leaving</label>
        <p class="">{{ isset($residence->prev_leaving_reason)?$residence->prev_leaving_reason:'' }}</p>
    </div>

</div><!--prev_address-->