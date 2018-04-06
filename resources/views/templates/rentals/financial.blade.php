<h3>Bank Accounts</h3>

<div class="well alert-info" style="background-color: #d9edf7; padding-bottom: 6%;">
    <p> This information is required by landlords and agents as part of their assessment of your financial qualifications. </p> 
    
    <div class="clearfix"></div>
    <div class="pretty p-image p-plain">
        <input type="checkbox" id="no_bank_account" name="finance_bank_account" value="no" />
        <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
          <label>I don't have any bank accounts</label>
        </div>
    </div>
    
</div><!--well-->

<div class="finance_bank_accounts">
    @if(count($finance) > 0)
    @foreach($finance as $fine)
    <div class="account-info">
        <div class="col-sm-6">
            <h4> Account Details </h4>
        </div>
        <div class="col-sm-6 text-right">
            <a href="javascript:void(0);" class="text-danger remove_bank_account"> <i class="fa fa-trash"></i> Remove</a>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label>Bank Name</label>
            <input type="text" name="finance_bank_name[]" value="{{ $fine->finance_bank_name }}" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Bank Address</label>
            <input type="text" name="finance_bank_address[]" value="{{ $fine->finance_bank_address }}" class="form-control">
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Account Number</label>
            <input type="text" name="finance_acc_number[]" value="{{ $fine->finance_acc_number }}"  class="form-control">
        </div>
        
        <div class="form-group col-sm-4">
            <label>Account Balance</label>
            <input type="text" name="finance_acc_balance[]" value="{{ $fine->finance_acc_balance }}" class="form-control">
        </div>

        <div class="form-group col-sm-4">
            <?php $accont_type = ''; ?>
            @if($fine->finance_acc_type)
                <?php $accont_type = $fine->finance_acc_type; ?>
            @endif
            <label>Account Type</label>
            <select class="form-control" name="finance_acc_type[]">
                <option value="Checkings" @if($accont_type=='Checkings') selected @endif >Checkings</option>
                <option value="Savings" @if($accont_type=='Savings') selected @endif >Savings</option>
            </select>
        </div>
    </div><!--account-info-->
    @endforeach
    @endif
    
    
    <!-- jquery used to put data here -->
</div>

<div class="col-sm-12">
    <button type="button" id="add_bank_account" class="btn btn-default"><i class="fa fa-plus"></i> Add Bank Account</button>
</div>

<div class="bank-wrapper" style="display:none;">
    <div class="account-info">
        <div class="col-sm-6">
            <h4> Account Details </h4>
        </div>
        <div class="col-sm-6 text-right">
            <a href="javascript:void(0);" class="text-danger remove_bank_account"> <i class="fa fa-trash"></i> Remove</a>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label>Bank Name</label>
            <input type="text" name="finance_bank_name[]" class="form-control">
        </div>

        <div class="form-group col-sm-6">
            <label>Bank Address</label>
            <input type="text" name="finance_bank_address[]" class="form-control">
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Account Number</label>
            <input type="text" name="finance_acc_number[]" class="form-control">
        </div>
        
        <div class="form-group col-sm-4">
            <label>Account Balance</label>
            <input type="text" name="finance_acc_balance[]" class="form-control">
        </div>

        <div class="form-group col-sm-4">
            <label>Account Type</label>
            <select class="form-control" name="finance_acc_type[]">
                <option value="Checkings">Checkings</option>
                <option value="Savings">Savings</option>
            </select>
        </div>
    </div><!--account-info-->
    
</div><!--bank-wrapper-->