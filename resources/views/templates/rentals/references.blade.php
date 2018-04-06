
    <h3>Personal Reference</h3>
    <div class="form-group col-sm-6">
        <label>Full Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="John Smith" id="ref_name" name="ref_name" value= "{{ isset($reference->ref_name)?$reference->ref_name:'' }}" />
    </div>
    <div class="form-group col-sm-6">
        <label>Relationship <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Relationship" id="ref_relation" name="ref_relation" value= "{{ isset($reference->ref_relation)?$reference->ref_relation:'' }}" />
    </div>
    
    <div class="form-group col-sm-6">
        <label>Address <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="123 Main street " id="ref_address" name="ref_address" value= "{{ isset($reference->ref_address)?$reference->ref_address:'' }}" />
    </div>
    <div class="form-group col-sm-6">
        <label>Phone Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Phone Number" id="ref_phone" name="ref_phone" value= "{{ isset($reference->ref_phone)?$reference->ref_phone:'' }}" />
    </div>
    
    <h3>Emergency Contact</h3>
    <div class="form-group col-sm-6">
        <label>Full Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="John Smith" id="emergency_name" name="emergency_name" value= "{{ isset($reference->emergency_name)?$reference->emergency_name:'' }}"  />
    </div>
    <div class="form-group col-sm-6">
        <label>Relationship <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Relationship" id="emergency_relation" name="emergency_relation" value= "{{ isset($reference->emergency_relation)?$reference->emergency_relation:'' }}" />
    </div>
    
    <div class="form-group col-sm-6">
        <label>Address <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="123 Main street " id="emergency_address" name="emergency_address" value= "{{ isset($reference->emergency_address)?$reference->emergency_address:'' }}" />
    </div>
    <div class="form-group col-sm-6">
        <label>Phone Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" placeholder="Phone Number" id="emergency_phone" name="emergency_phone" value= "{{ isset($reference->emergency_phone)?$reference->emergency_phone:'' }}"  />
    </div>
    
