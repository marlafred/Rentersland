<div class="row">
    <span class="step-label">Contact Info</span>
    <div class="content">
        <div class="form-group col-sm-6">
            <label>Name</label>
            <div class="input-group date">
                <input class="form-control" name="contact_name" type="text" placeholder="Contact Person Name" value="{{ isset($listing->contact_name)?$listing->contact_name:Auth::user()->first_name }}">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label>Email</label>
            <div class="input-group date">
                <input class="form-control" name="contact_email" type="text" placeholder="Contact Person Email" value="{{ isset($listing->contact_email)?$listing->contact_email:Auth::user()->email }}">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label>Mobile</label>
            <div class="input-group date">
                <input class="form-control" name="contact_phone" type="text" placeholder="Contact Person Phone" value="{{ isset($listing->contact_phone)?$listing->contact_phone:Auth::user()->phone_number }}">
                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label>Phone</label>
            <div class="input-group date">
                <input class="form-control" name="contact_mobile" type="text" placeholder="Contact Person Phone" value="{{ isset($listing->contact_mobile)?$listing->contact_mobile:Auth::user()->phone_number }}">
                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
            </div>
        </div>


        <hr>
        <div class="form-group col-sm-12">
            <h3 class="c-heading">Notes</h3>
            <textarea name="notes" class="form-control" rows="5" placeholder="Contact Notes">{{ isset($listing->notes)?$listing->notes:'' }}</textarea>
        </div>

        <div class="form-group col-sm-12 text-right">
            <a href="javascript:void(0)" class="btn btn-back btn-red" curr="step4" prev="step3" next="step5">Back</a>
            <a href="javascript:void(0)" class="btn btn-clrd btn-next" curr="step4" prev="step3" next="step5">Next</a>
        </div>

    </div>
</div>