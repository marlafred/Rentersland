
    <h3>Current Occupation</h3>
    <div class="col-sm-3">
        <label class="big" style="margin-right: 14px;">Status</label>
        <p class="">{{ isset($occupation->curr_job_status)?$occupation->curr_job_status:'' }}</p>
    </div>
    <div class="clearfix"></div>
    <div class="curr_employed">
        <div class="form-group col-sm-4">
            <label>Employer</label>
            <p class="">{{ isset($occupation->curr_employer)?$occupation->curr_employer:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Job Title</label>
            <p class="">{{ isset($occupation->curr_job_title)?$occupation->curr_job_title:'' }}</p>
        </div>

        <div class="form-group col-sm-4">
            <label>Monthly Salary</label>
            <p class="">{{ isset($occupation->curr_salary)?$occupation->curr_salary:'' }}</p>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Work Type </label>
            <p class="">{{ isset($occupation->curr_salary)?$occupation->curr_salary:'' }}</p>
        </div>

        <div class="form-group col-sm-4">
            <label>Manager Name</label>
            <p class="">{{ isset($occupation->curr_manager)?$occupation->curr_manager:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Employer/Manager Phone </label>
            <p class="">{{ isset($occupation->curr_employer_contact)?$occupation->curr_employer_contact:'' }}</p>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Work Address</label>
            <p class="">{{ isset($occupation->curr_work_address)?$occupation->curr_work_address:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Join Date</label>
            <p class="">{{ isset($occupation->curr_join_date)?$occupation->curr_join_date:'' }}</p>
        </div>
    </div><!--employed-->
    <div class="clearfix"></div>
    <div class="curr_unemployed" style="display:none;">
        <div class="form-group col-sm-4">
            <label>Income Source</label>
            <p class="">{{ isset($occupation->curr_income_source)?$occupation->curr_income_source:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Monthly Income</label>
            <p class="">{{ isset($occupation->curr_monthly_income)?$occupation->curr_monthly_income:'' }}</p>
        </div>
    </div><!--unemplyed-->
    
    <div class="clearfix"></div>
    
    <h3>Previous Occupation</h3>
    
    <div class="col-sm-3">
        <label class="big" style="margin-right: 14px;">Status</label>
        <p class=""> {{ isset($occupation->prev_job_status)?$occupation->prev_job_status:'' }} </p>
    </div>
    
    <div class="clearfix"></div>
   
    <?php $style = ''; ?>
    @if(isset($occupation->prev_job_status) and ($occupation->prev_job_status=='none' or $occupation->prev_job_status==''))
        <?php $style = 'display:none;'; ?>
    @endif
    
    <div class="prev_employed" style="{{ $style }}">
        <div class="form-group col-sm-4">
            <label>Employer</label>
            <p class="">{{ isset($occupation->prev_employer)?$occupation->prev_employer:'' }}" </p>
        </div>
        <div class="form-group col-sm-4">
            <label>Job Title</label>
            <p class="">{{ isset($occupation->prev_job_title)?$occupation->prev_job_title:'' }}</p>
        </div>

        <div class="form-group col-sm-4">
            <label>Monthly Salary</label>
            <p class="">{{ isset($occupation->prev_salary)?$occupation->prev_salary:'' }}</p>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
           <label>Work Type</label>
            <p class="">{{ isset($occupation->prev_salary) and $occupation->prev_salary!='' }}</p>
        </div>

        <div class="form-group col-sm-4">
            <label>Manager Name</label>
            <p class="">{{ isset($occupation->prev_manager)?$occupation->prev_manager:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Employer/Manager Phone</label>
            <p class="">{{ isset($occupation->prev_employer_contact)?$occupation->prev_employer_contact:'' }}</p>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Work Address</label>
            <p class="">{{ isset($occupation->prev_work_address)?$occupation->prev_work_address:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Join Date</label>
            <p>{{ isset($occupation->prev_join_date)?$occupation->prev_join_date:'' }}</p>
        </div>
    </div><!--employed-->
    <div class="clearfix"></div>
    <div class="prev_unemployed">
        <div class="form-group col-sm-4">
            <label>Income Source</label>
            <p class="">{{ isset($occupation->prev_income_source)?$occupation->prev_income_source:'' }}</p>
        </div>
        <div class="form-group col-sm-4">
            <label>Monthly Income</label>
            <p class="">{{ isset($occupation->prev_monthly_income)?$occupation->prev_monthly_income:'' }}</p>
        </div>
    </div><!--unemplyed-->
    
    <div class="clearfix"></div>
