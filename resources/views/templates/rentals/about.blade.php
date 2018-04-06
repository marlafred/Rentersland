<h3>About Me </h3>
<div class="form-group col-sm-4">
    <label>First Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control" required="" placeholder="First Name" id="first_name" name="first_name" value="{{ isset($about->first_name)?$about->first_name:Auth::user()->first_name }}" />
</div>
<div class="form-group col-sm-4">
    <label>Middle Name</label>
    <input type="text" class="form-control" placeholder="Middle Name" id="middle_name" name="middle_name" value="{{ isset($about->middle_name)?$about->middle_name:'' }}" />
</div>
<div class="form-group col-sm-4">
    <label>Last Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control" required="" placeholder="Last Name" id="last_name" name="last_name" value="{{ isset($about->last_name)?$about->last_name:Auth::user()->last_name }}" />
</div>

<div class="clearfix"></div>

<div class="form-group col-sm-6">
    <label>Email <span class="text-danger">*</span></label>
    <input type="email" class="form-control" required="" placeholder="Email Address" id="email" name="email" value="{{ isset($about->email)?$about->email:Auth::user()->email }}" />
</div>
<div class="form-group col-sm-6">
    <label>Phone Number <span class="text-danger">*</span></label>
    <input type="text" class="form-control" required="" placeholder="Phone" id="phone" name="phone" value="{{ isset($about->phone)?$about->phone:Auth::user()->phone_number }}" />
</div>

<div class="form-group col-sm-6">
    <label>Date of Birth <span class="text-danger">*</span></label>
    <input type="text" id="dob" class="form-control" required="" placeholder="Date of Birth" data-date-format="dd-mm-yyyy" data-date-viewmode="years" name="dob" value="{{ isset($about->dob)?$about->dob:'' }}" />
</div>
<div class="form-group col-sm-6">
    <label>Social Secuirty No. </label>
    <input type="text" class="form-control" placeholder="Social Secuirty No." id="security_no" name="security_no" value="{{ isset($about->security_no)?$about->security_no:'' }}" />
</div>

<div class="form-group col-sm-6">
    <label>Driving License No. </label>
    <input type="text" class="form-control" placeholder="License Number" id="license_no" name="license_no" value="{{ isset($about->license_no)?$about->license_no:'' }}" />
</div>
<div class="form-group col-sm-6">
    <label>Driving License State. </label>
    <input type="text" class="form-control" placeholder="License State" id="license_state" name="license_state" value="{{ isset($about->license_state)?$about->license_state:'' }}" />
</div>