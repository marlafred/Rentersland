<div class="row">
    <span class="step-label">Location</span>
    <div class="content">

        <div class="form-group col-sm-12">
            <label>Description <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Description" value="{{ isset($listing->title)?$listing->title:'' }}" id="title" name="title" />
        </div>
        <div class="form-group col-sm-12">
                <label>Address <span class="text-danger">*</span></label>

                <input type="text" class="form-control" placeholder="Address" value="{{ isset($listing->address)?$listing->address:'' }}" id="searchAddress" name="address" />
        </div>
        <div class="form-group col-sm-6">
                <label>Street No. </label>
                <input type="text" class="form-control" placeholder="Street" id="street_no"  name="street_no" value="{{ isset($listing->street_no)?$listing->street_no:'' }}" />
        </div>
        <div class="form-group col-sm-6">
                <label>Unit</label>
                <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit" value="{{ isset($listing->unit)?$listing->unit:'' }}" />
        </div>
        <div class="form-group col-sm-6">
                <label>Street Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Street Name" value="{{ isset($listing->street_name)?$listing->street_name:'' }}"  />
        </div>
        <div class="form-group col-sm-6">
                <label>City/ Town <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ isset($listing->city)?$listing->city:'' }}"/>
        </div>
        <div class="form-group col-sm-6">
                <label>Zip Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zip Code" value="{{ isset($listing->zipcode)?$listing->zipcode:'' }}" />
        </div>
        <div class="form-group col-sm-12">
                <label>Map</label>
                <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                <!--<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13613.44347264889!2d74.27075075!3d31.459257849999997!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1512998704236" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
        </div> 
        <div class="form-group col-sm-12 text-right">
            <a href="javascript:void(0)" class="btn btn-clrd btn-next" curr="step1" prev="" next="step2">next</a>    
        </div>  

        <input type="hidden" name="lat" id="lat" value="{{ isset($listing->lat)?$listing->lat:'' }}" >
        <input type="hidden" name="lng" id="lng" value="{{ isset($listing->lng)?$listing->lng:'' }}" >
        <input type="hidden" name="country" id="country" value="{{ isset($listing->country)?$listing->country:'' }}" >
        <input type="hidden" name="state" id="state" value="{{ isset($listing->state)?$listing->state:'' }}" >

    </div>
</div><!--row-->