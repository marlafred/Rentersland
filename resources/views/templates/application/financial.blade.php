<h3>Bank Accounts</h3>
<div class="finance_bank_accounts">
    @if(count($finance) > 0)
    @foreach($finance as $fine)
    <div class="account-info">
        <div class="col-sm-6">
            <h4> Account Details </h4>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Bank Name</label>
            <p class="">{{ isset($fine->finance_bank_name)?$fine->finance_bank_name:'' }}</p>
        </div>

        <div class="form-group col-sm-4">
            <label>Bank Address</label>
            <p class="">{{ $fine->finance_bank_address }}</p>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-sm-4">
            <label>Account Number</label>
            <p class="">{{ $fine->finance_acc_number }}</p>
        </div>
        
        <div class="form-group col-sm-4">
            <label>Account Balance</label>
            <p class="">{{ $fine->finance_acc_balance }}</p>
        </div>

        <div class="form-group col-sm-4">
            <label>Account Type</label>
            <p class=""> {{ $fine->finance_acc_type }}</p>
        </div>
        <div class="clearfix"></div>
    </div><!--account-info-->
    
    @endforeach
    @endif
    
    
    <!-- jquery used to put data here -->
</div>
