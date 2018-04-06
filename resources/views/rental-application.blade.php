@extends('master')
@section('title', 'Rental Application')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Rental Application</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="javascript:void(0);">Tenant Application</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
    
        @include('templates.rentals.sidebar')
        
        <div class="overlay-box step1">
            <form id="about_form" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">ABOUT</span>
                    <div class="content">
                        @include('templates.rentals.about')

                        <div class="form-group col-sm-12 text-right">
                            <button type="submit" class="btn btn-clrd" curr="step1" prev="" next="step2">Save & Continue</button>
                        </div>

                    </div>
                </div>
            </form>
        </div><!--step1-->
        
        <div class="overlay-box step2">
            <form id="residences" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">RESIDENCES</span>
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
        
        <div class="overlay-box step3">
            <form id="occupation" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">OCCUPATION</span>
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
        
        <div class="overlay-box step4">
            <form id="references" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">REFERENCES</span>
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
        
        <div class="overlay-box step5">
            <form id="tenantinfos" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">ADDITIONAL</span>
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
        
        <div class="overlay-box step6">
            <form id="tenantfinances" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">FINANCIAL</span>
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
        
        <div class="overlay-box step7">
            <form id="tenantloans" onsubmit="return false;">
                {{ csrf_field() }}
                <div class="row">
                    <span class="step-label">EXTRAS</span>
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

@stop

@section('script')
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">

<script>
    $(document).ready(function(){
        $('.overlay-box').hide();
        $('.step1').show();
       
        $('.btn-next').on('click', function(e){
            var flag = true;
            $('.overlay-box').hide();
            var next = $(this).attr('next');
            
            if(flag){
                $('.'+next).show();
                $('html, body').animate({ 
                    scrollTop: $('.'+next).offset().top
                });
            }else{
                curr = $(this).attr('curr');
                $('.'+curr).show();
                $('html, body').animate({ 
                    scrollTop: $('.'+curr).offset().top
                });
            }
        });
        
        $('.btn-back').on('click', function(e){
            $('.overlay-box').hide();
            var prev = $(this).attr('prev');
            $('.'+prev).show();
            $('html, body').animate({ 
                scrollTop: $('.'+prev).offset().top
            });
        });
        
        $('.steps-nav li a').on('click', function(){
            $('.overlay-box').hide();
            var step = $(this).attr('step');
            
            $('.'+step).show();
            $('.steps-nav li').removeClass('current');
            $('.'+step).addClass('active current');
            $('html, body').animate({ 
                scrollTop: $('div.'+step).offset().top
            });
        });
        
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
                $('.step1').hide();
                $('.step2').show();
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
                $('.step2').hide();
                $('.step3').show();
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
                $('.step3').hide();
                $('.step4').show();
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
                $('.step4').hide();
                $('.step5').show();
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
                $('.step5').hide();
                $('.step6').show();
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
                $('.step6').hide();
                $('.step7').show();
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
               /* $('.step2').hide();
                $('.step3').show();*/
            }
         }
       });
   });/*tenantloans*/
   
});

</script>
@stop