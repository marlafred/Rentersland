<h3>Outstanding Loans</h3>
<div class="extras_loans">
    @if(count($loan) > 0)
    @foreach($loan as $req)
    <div class="loan-info">
        <div class="col-sm-6">
            <h4> Loan Details </h4>
        </div>
       
        <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label>Creditor Name</label>
            <p class="">{{ $req->extras_creditor_name }}</p>
        </div>

        <div class="form-group col-sm-6">
            <label>Creditor Address</label>
            <p class="">{{ $req->extras_creditor_address }}</p>
        </div>

        <div class="form-group col-sm-6">
            <label>Phone Number</label>
            <p class="">{{ $req->extras_creditor_phone }}</p>
        </div>

        <div class="form-group col-sm-6">
            <label>Monthly Payment</label>
            <p class="">{{ $req->extras_creditor_payment }}</p>
        </div>
    </div><!--account-info-->
    @endforeach
    @endif
    
    <!-- jquery used to put data here -->
</div>
