<h3>Personal Reference</h3>
<div class="form-group col-sm-6">
    <label>Full Name <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->ref_name)?$reference->ref_name:'' }} </p>
</div>
<div class="form-group col-sm-6">
    <label>Relationship <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->ref_relation)?$reference->ref_relation:'' }}</p>
</div>

<div class="form-group col-sm-6">
    <label>Address <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->ref_address)?$reference->ref_address:'' }}</p>
</div>
<div class="form-group col-sm-6">
    <label>Phone Number <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->ref_phone)?$reference->ref_phone:'' }}</p>
</div>

<h3>Emergency Contact</h3>
<div class="form-group col-sm-6">
    <label>Full Name <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->emergency_name)?$reference->emergency_name:'' }}</p>
</div>
<div class="form-group col-sm-6">
    <label>Relationship <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->emergency_relation)?$reference->emergency_relation:'' }}</p>
</div>

<div class="form-group col-sm-6">
    <label>Address <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->emergency_address)?$reference->emergency_address:'' }}</p>
</div>
<div class="form-group col-sm-6">
    <label>Phone Number <span class="text-danger">*</span></label>
    <p class="">{{ isset($reference->emergency_phone)?$reference->emergency_phone:'' }}</p>
</div>
    
