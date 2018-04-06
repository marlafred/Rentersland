<h3>Outstanding Loans</h3>

<div class="well alert-info" style="background-color: #d9edf7;">
    <p> This information is required by landlords and agents as part of their assessment of your financial qualifications. </p>
</div><!--well-->

<div class="extras_loans">
    @if(count($loan) > 0)
    @foreach($loan as $req)
    <div class="loan-info">
        <div class="col-sm-6">
            <h4> Loan Details </h4>
        </div>
        <div class="col-sm-6 text-right">
            <a href="javascript:void(0);" class="text-danger remove_loan_info"> <i class="fa fa-trash"></i> Remove</a>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label>Creditor Name</label>
            <input type="text" name="extras_creditor_name[]" value="{{ $req->extras_creditor_name }}" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Creditor Address</label>
            <input type="text" name="extras_creditor_address[]" value="{{ $req->extras_creditor_address }}" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Phone Number</label>
            <input type="text" name="extras_creditor_phone[]" value="{{ $req->extras_creditor_phone }}" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Monthly Payment</label>
            <input type="text" name="extras_creditor_payment[]" value="{{ $req->extras_creditor_payment }}" class="form-control">
        </div>
    </div><!--account-info-->
    @endforeach
    @endif
    
    <!-- jquery used to put data here -->
</div>


<div class="col-sm-12">
    <button type="button" id="add_loan_details" class="btn btn-default"><i class="fa fa-plus"></i> Add Loan Details</button>
</div>

<div class="loan-wrapper" style="display:none;">
    <div class="loan-info">
        <div class="col-sm-6">
            <h4> Loan Details </h4>
        </div>
        <div class="col-sm-6 text-right">
            <a href="javascript:void(0);" class="text-danger remove_loan_info"> <i class="fa fa-trash"></i> Remove</a>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label>Creditor Name</label>
            <input type="text" name="extras_creditor_name[]" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Creditor Address</label>
            <input type="text" name="extras_creditor_address[]" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Phone Number</label>
            <input type="text" name="extras_creditor_phone[]" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Monthly Payment</label>
            <input type="text" name="extras_creditor_payment[]" class="form-control">
        </div>
    </div><!--account-info-->
    
</div><!--loan-wrapper-->