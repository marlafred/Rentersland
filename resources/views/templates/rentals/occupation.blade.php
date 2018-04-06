
    <h3>Current Occupation</h3>
    <div class="col-sm-3">
        <label class="big" style="margin-right: 14px;">Status</label>
    </div>
    <div class="col-sm-9">
        <?php $curr_job = isset($occupation->curr_job_status)?$occupation->curr_job_status:''; ?>
        <div class="pretty p-image p-plain">
            <input type="radio" class="curr_job_status" name="curr_job_status" value="employed" @if($curr_job=='' or $curr_job=='employed') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Employed</label>
            </div>
        </div>

        <div class="pretty p-image p-plain">
            <input type="radio" class="curr_job_status" name="curr_job_status" value="student" @if($curr_job=='student') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Student</label>
            </div>
        </div>
        <div class="pretty p-image p-plain">
            <input type="radio" class="curr_job_status" name="curr_job_status" value="unemployed" @if($curr_job=='unemployed') checked @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Unemployed</label>
            </div>
        </div>
    </div>
    
    <div class="curr_employed">
        <div class="form-group col-sm-6">
            <label>Employer</label>
            <input type="text" class="form-control" placeholder="Current Employer" value="{{ isset($occupation->curr_employer)?$occupation->curr_employer:'' }}" id="curr_employer" name="curr_employer" />
        </div>
        <div class="form-group col-sm-6">
            <label>Job Title</label>
            <input type="text" class="form-control" placeholder="Current Job Title" id="curr_job_title" name="curr_job_title" value="{{ isset($occupation->curr_job_title)?$occupation->curr_job_title:'' }}" />
        </div>

        <div class="form-group col-sm-6">
            <label>Monthly Salary</label>
            <input type="text" class="form-control" placeholder="Monthly Salary" id="curr_salary" name="curr_salary" value="{{ isset($occupation->curr_salary)?$occupation->curr_salary:'' }}" />
        </div>
        <div class="form-group col-sm-6">
            <?php $curr_work_type = isset($occupation->curr_salary)?$occupation->curr_salary:''; ?>
            <label>Work Type </label>
            <select class="form-control" name="curr_work_type" id="curr_work_type">
                <option value="full-time" @if($curr_work_type=='full-time') selected @endif >Full Time</option>
                <option value="part-time" @if($curr_work_type=='part-time') selected @endif >Part Time</option>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label>Manager Name</label>
            <input type="text" class="form-control" placeholder="Manager/Boss Name" value="{{ isset($occupation->curr_manager)?$occupation->curr_manager:'' }}" id="curr_manager" name="curr_manager" />
        </div>
        <div class="form-group col-sm-6">
            <label>Employer/Manager Phone </label>
            <input type="text" class="form-control" placeholder="Phone Number" value="{{ isset($occupation->curr_employer_contact)?$occupation->curr_employer_contact:'' }}" id="curr_employer_contact" name="curr_employer_contact" />
        </div>

        <div class="form-group col-sm-6">
            <label>Work Address</label>
            <input type="text" class="form-control" placeholder="Work Address" value="{{ isset($occupation->curr_work_address)?$occupation->curr_work_address:'' }}" id="curr_work_address" name="curr_work_address" />
        </div>
        <div class="form-group col-sm-6">
            <label>Join Date</label>
            <input type="text" class="form-control datepicker" placeholder="Join Date" value="{{ isset($occupation->curr_join_date)?$occupation->curr_join_date:'' }}" id="curr_join_date" name="curr_join_date" />
        </div>
    </div><!--employed-->
    
    <div class="curr_unemployed" style="display:none;">
        <div class="form-group col-sm-6">
            <label>Income Source</label>
            <input type="text" class="form-control" placeholder="Income Source" value="{{ isset($occupation->curr_income_source)?$occupation->curr_income_source:'' }}" id="curr_income_source" name="curr_income_source" />
        </div>
        <div class="form-group col-sm-6">
            <label>Monthly Income</label>
            <input type="text" class="form-control" placeholder="Monthly Income" value="{{ isset($occupation->curr_monthly_income)?$occupation->curr_monthly_income:'' }}" id="curr_monthly_income" name="curr_monthly_income" />
        </div>
    </div><!--unemplyed-->
    
    <div class="clearfix"></div>
    
    <h3>Previous Occupation</h3>
    <?php $prev_job = isset($occupation->prev_job_status)?$occupation->prev_job_status:''; ?>
    <div class="col-sm-3">
        <label class="big" style="margin-right: 14px;">Status</label>
    </div>
    <div class="col-sm-9">
        <div class="pretty p-image p-plain">
            <input type="radio" class="prev_job_status" name="prev_job_status" value="employed" @if($prev_job=='employed' or $prev_job=='') checked  @endif />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Employed</label>
            </div>
        </div>
        <div class="pretty p-image p-plain">
            <input type="radio" class="prev_job_status" name="prev_job_status" value="student" @if($prev_job=='student') checked  @endif  />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Student</label>
            </div>
        </div>
        <div class="pretty p-image p-plain">
            <input type="radio" class="prev_job_status" name="prev_job_status" value="unemployed" @if($prev_job=='unemployed') checked  @endif  />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>Unemployed</label>
            </div>
        </div>
        <div class="pretty p-image p-plain">
            <input type="radio" class="prev_job_status" name="prev_job_status" value="none" @if($prev_job=='none') checked  @endif  />
            <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
              <label>None</label>
            </div>
        </div>
    </div><!--col-sm-9-->
    <?php $style = ''; ?>
    @if($prev_job=='none' or $prev_job=='')
        <?php $style = 'display:none;'; ?>
    @endif
    
    <div class="prev_employed" style="{{ $style }}">
        <div class="form-group col-sm-6">
            <label>Employer</label>
            <input type="text" class="form-control" placeholder="Previous Employer" id="prev_employer" name="prev_employer" value="{{ isset($occupation->prev_employer)?$occupation->prev_employer:'' }}" />
        </div>
        <div class="form-group col-sm-6">
            <label>Job Title</label>
            <input type="text" class="form-control" placeholder="Previous Job Title" id="prev_job_title" name="prev_job_title" value="{{ isset($occupation->prev_job_title)?$occupation->prev_job_title:'' }}" />
        </div>

        <div class="form-group col-sm-6">
            <label>Monthly Salary</label>
            <input type="text" class="form-control" placeholder="Monthly Salary" id="prev_salary" name="prev_salary" value="{{ isset($occupation->prev_salary)?$occupation->prev_salary:'' }}" />
        </div>
        <div class="form-group col-sm-6">
            <?php $prev_salary = ''; ?>
            @if(isset($occupation->prev_salary) and $occupation->prev_salary!='')
            <?php $prev_salary = $occupation->prev_salary; ?>
            @endif
            
            <label>Work Type</label>
            <select class="form-control" name="prev_work_type" id="prev_work_type">
                <option value="full-time" @if($prev_salary == 'full-time') selected @endif >Full Time</option>
                <option value="part-time" @if($prev_salary == 'part-time') selected @endif >Part Time</option>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label>Manager Name</label>
            <input type="text" class="form-control" placeholder="Manager/Boss Name" id="prev_manager" name="prev_manager" value="{{ isset($occupation->prev_manager)?$occupation->prev_manager:'' }}" />
        </div>
        <div class="form-group col-sm-6">
            <label>Employer/Manager Phone</label>
            <input type="text" class="form-control" placeholder="Phone Number" id="prev_employer_contact" name="prev_employer_contact" value="{{ isset($occupation->prev_employer_contact)?$occupation->prev_employer_contact:'' }}" />
        </div>

        <div class="form-group col-sm-6">
            <label>Work Address</label>
            <input type="text" class="form-control" placeholder="Work Address" id="prev_work_address" name="prev_work_address" value="{{ isset($occupation->prev_work_address)?$occupation->prev_work_address:'' }}" />
        </div>
        <div class="form-group col-sm-6">
            <label>Join Date</label>
            <input type="text" class="form-control datepicker" placeholder="Join Date" id="prev_join_date" name="prev_join_date" value="{{ isset($occupation->prev_join_date)?$occupation->prev_join_date:'' }}" />
        </div>
    </div><!--employed-->
    
    <div class="prev_unemployed">
        <div class="form-group col-sm-6">
            <label>Income Source</label>
            <input type="text" class="form-control" placeholder="Income Source" id="prev_income_source" name="prev_income_source" value="{{ isset($occupation->prev_income_source)?$occupation->prev_income_source:'' }}" />
        </div>
        <div class="form-group col-sm-6">
            <label>Monthly Income</label>
            <input type="text" class="form-control" placeholder="Monthly Income" id="prev_monthly_income" name="prev_monthly_income" value="{{ isset($occupation->prev_monthly_income)?$occupation->prev_monthly_income:'' }}" />
        </div>
    </div><!--unemplyed-->
    
    <div class="clearfix"></div>
