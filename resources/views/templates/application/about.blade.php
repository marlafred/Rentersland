<div class="form-group col-sm-4">
    <label>First Name </label>
    <p class="">{{ isset($about->first_name)?$about->first_name:Auth::user()->first_name }}</p>
</div>
<div class="form-group col-sm-4">
    <label>Middle Name</label>
    <p class="">{{ isset($about->middle_name)?$about->middle_name:'' }}</p>
</div>
<div class="form-group col-sm-4">
    <label>Last Name</label>
    <p class="">{{ isset($about->last_name)?$about->last_name:Auth::user()->last_name }}</p>
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-4">
    <label>Email</label>
    <p class="">{{ isset($about->email)?$about->email:Auth::user()->email }}</p>
</div>
<div class="form-group col-sm-4">
    <label>Phone Number</label>
    <p class="">{{ isset($about->phone)?$about->phone:Auth::user()->phone_number }}</p>
</div>

<div class="form-group col-sm-4">
    <label>Date of Birth</label>
    <p class="">{{ isset($about->dob)?$about->dob:'' }}</p>
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-4">
    <label>Social Secuirty No. </label>
    <p class="">{{ isset($about->security_no)?$about->security_no:'' }}</p>
</div>

<div class="form-group col-sm-4">
    <label>Driving License No. </label>
    <p class="">{{ isset($about->license_no)?$about->license_no:'' }}</p>
</div>
<div class="form-group col-sm-4">
    <label>Driving License State. </label>
    <p class="">{{ isset($about->license_state)?$about->license_state:'' }}</p>
</div>