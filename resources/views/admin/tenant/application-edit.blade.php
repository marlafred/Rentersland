@extends('adminlte::page')
@section('title', 'Tenant Application')
@section('content')

<section style="padding: 0 6%;">

        <div class="box">
        <div class="tabs">
        	
            <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#step1">ABOUT</a></li>
                  <li><a data-toggle="tab" href="#step2">RESIDENCES</a></li>
                  <li><a data-toggle="tab" href="#step3">OCCUPATION</a></li>
                  <li><a data-toggle="tab" href="#step4">REFERENCES</a></li>
                  <li><a data-toggle="tab" href="#step5">ADDITIONAL</a></li>
                  <li><a data-toggle="tab" href="#step6">FINANCIAL</a></li>
                  <li><a data-toggle="tab" href="#step7">EXTRAS</a></li>
                </ul>
            </div>
          
            </div><!--row-->
            
            <div class="tab-content tabs-body">
                  <div class="tab-pane fade in active" id="step1">
                        <form id="about_form" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                                
                                <div class="content">
                                    @include('templates.rentals.about')

                                    <div class="form-group col-sm-12 text-right">
                                        <button type="submit" class="btn btn-clrd" curr="step1" prev="" next="step2">Save & Continue</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div><!--step1-->

                    <div class="tab-pane fade" id="step2">
                        <form id="residences" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                                
                                <div class="content">
                                    @include('templates.rentals.residencies')

                                    <div class="form-group col-sm-12 text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-back" curr="step2" prev="step1" next="step3">Back</a>
                                        <button type="submit" class="btn btn-clrd" curr="step2" prev="" next="step3">Save & Continue</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!--step2-->

                    <div class="tab-pane fade" id="step3">
                        <form id="occupation" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                                
                                <div class="content">
                                    @include('templates.rentals.occupation')

                                    <div class="form-group col-sm-12 text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-back" curr="step3" prev="step2" next="step4">Back</a>
                                        <button type="submit" class="btn btn-clrd" curr="step3" prev="" next="step4">Save & Continue</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div><!--step3-->

                    <div class="tab-pane fade" id="step4">
                        <form id="references" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                               
                                <div class="content">
                                    @include('templates.rentals.references')

                                    <div class="form-group col-sm-12 text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-back" curr="step4" prev="step3" next="step5">Back</a>
                                        <button type="submit" class="btn btn-clrd" curr="step4" prev="" next="step5">Save & Continue</button>                    
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div><!--step4-->

                    <div class="tab-pane fade" id="step5">
                        <form id="tenantinfos" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                                
                                <div class="content">
                                    @include('templates.rentals.additional')

                                    <div class="form-group col-sm-12 text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-back" curr="step5" prev="step4" next="step6">Back</a>
                                        <button type="submit" class="btn btn-clrd" curr="step5" prev="" next="step6">Save & Continue</button>                    
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div><!--step5-->

                    <div class="tab-pane fade" id="step6">
                        <form id="tenantfinances" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                                
                                <div class="content">
                                    @include('templates.rentals.financial')

                                    <div class="form-group col-sm-12 text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-back" curr="step6" prev="step5" next="step7">Back</a>
                                        <button type="submit" class="btn btn-clrd" curr="step6" prev="" next="step7">Save & Continue</button>                    
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div><!--step6-->

                    <div class="tab-pane fade" id="step7">
                        <form id="tenantloans" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="row">
                                
                                <div class="content">
                                    @include('templates.rentals.extras')

                                    <div class="form-group col-sm-12 text-right">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-back" curr="step6" prev="step5" next="step7">Back</a>
                                        <button type="submit" class="btn btn-clrd">Done</button>                
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div><!--step7-->

            </div>

            </div><!--tab-content-->
        
        </div>
    </div>
</section>

@stop

@section('js')
<style>
    .tab-pane .row {
       padding-right: 20%;
       padding-left: 2%; 
    }
    .tab-pane .row h3{
       padding-left: 2%; 
    }
    
    .btn-back { display: none; }
        
</style>

<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">

<script>
    $(document).ready(function(){
      
        /*Residence*/
        $('.curr_housing_type').on('change', function(){
            if($(this).val()=='rented'){
                $('.curr_rented').show();
            }else{
                $('.curr_rented').hide();
            }
        });/*curr_housing_type*/
        
        $('.prev_housing_type').on('change', function(){
            $('.prev_address_wrapper').show();
            $('.prev_rented').show();
            
            if($(this).val()=='rented'){
                $('.prev_rented').show();
            }else if($(this).val()=='owned'){
                $('.prev_rented').hide();
            }else{
                $('.prev_address_wrapper').hide();
            }
            
        });/*prev_housing_type*/
        
        $('.curr_job_status').on('change', function(){
            $('.curr_employed').hide();
            $('.curr_unemployed').hide();
            
            if($(this).val()=='employed'){
                $('.curr_employed').show();
            }else{
                $('.curr_unemployed').show();
            }
        });/*curr_job_status*/
        
        $('.prev_job_status').on('change', function(){
            $('.prev_employed').hide();
            $('.prev_unemployed').hide();
            
            if($(this).val()=='employed'){
                $('.prev_employed').show();
            }else{
                $('.prev_unemployed').show();
            }
        });/*curr_job_status*/
        
        $('#add_bank_account').on('click', function(){
            var length = $('.finance_bank_accounts').find('.account-info').length;
            length = length + 1;
            $('.finance_bank_accounts').append($('.bank-wrapper').html())
        });
        
        $('#no_bank_account').on('change', function(){
           if($(this).is(':checked')){
              $('.finance_bank_accounts').hide();
              $('#add_bank_account').hide();
           }else{
              $('.finance_bank_accounts').show();
              $('#add_bank_account').show();
            } 
        });
        
        $(document).on('click', '.remove_bank_account', function(){
            $(this).parents('.account-info').remove();
        });
        
        /*Extras*/
        $('#add_loan_details').on('click', function(){
            $('.extras_loans').append($('.loan-wrapper').html());
        });
        $(document).on('click', '.remove_loan_info', function(){
           $(this).parents('.loan-info').remove(); 
        });
    });
</script>


<script>
$(document).ready(function(){
   $('#about_form').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantabouts') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
               alert("Updated Successfully");
            }
         }
       });
   });/*about*/
   
   $('#residences').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantresidences') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
             
                alert("Updated Successfully");
            }
         }
       });
   });/*residences*/
   
   $('#occupation').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantoccupation') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
              alert("Updated Successfully");
            }
         }
       });
   });/*occupation*/
   
   $('#references').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantreferences') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
                alert("Updated Successfully");
            }
         }
       });
   });/*references*/
   
   $('#tenantinfos').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantinfos') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
                alert("Updated Successfully");
            }
         }
       });
   });/*tenantinfos*/
   
   $('#tenantfinances').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantfinances') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
                alert("Updated Successfully");
            }
         }
       });
   });/*tenantinfos*/
   
   $('#tenantloans').on('submit', function(){
       $.ajax({
         type:"POST",
         url:"{{ route('submit.tenantloans') }}",
         data : $(this).serialize(),
         success: function(data){
            if(data=='success'){
                alert("Updated Successfully");
            }
         }
       });
   });/*tenantloans*/
   
});

</script>
@stop