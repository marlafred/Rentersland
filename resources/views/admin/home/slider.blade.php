@extends('adminlte::page')

@section('title', 'Home Page Setting')

@section('content')

<section>
    <div class="row">
        <div class="col-md-3">
            @include('admin.home.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-cog"></i> How It Works </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
           
                    <form method="post" id="slider_form" class="slider_form" onSubmit="return false" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="slider-images">

                            @if(count($slides) > 0)
                                <?php $count = 0; ?>
                                @foreach($slides as $slide)
                                    <?php $count++; ?>
                                    <div class="col-md-6">
                                        <div class="img-block img-size-1">

                                            <div class="ib-container-block">
                                                <div class="input-container">
                                                    <div class="input-group" style="width: 92%; float: left;">
                                                       <span class="input-group-btn" style="position: absolute;right: 0;top: 0;">
                                                            <button type="button" class="btn btn-danger remove-image"><i class="fa fa-trash"></i></button>
                                                        </span>
                                                   </div>
                                                </div>
                                                <img class="img-responsive" id="img1" src="{{ asset('slides/') }}/{{ $slide->image }}" style="width:396px; height: 200px;">

                                            </div>
                                        </div>
                                        <input type="hidden" name="exist_images[]" value="{{ $slide->image }}">
                                    </div><!--col-sm-4-->
                                    @if($count%2==0)
                                    <div class="clearfix"></div><br>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="form-group col-sm-12 text-right">
                            <button type="button" class="btn btn-primary" id="add_new"><i class="fa fa-plus"></i> Add New </button>
                            <button type="submit" class="btn btn-success" ><i class="fa fa-upload"></i> Update </button>
                        </div>
                </div><!--row-->
                
                <div class="clearfix"></div>
            </form>
           </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>

<div class="add-slide" style="display:none;">
    
    <div class="col-md-6">
        <div class="img-block img-size-1">

            <div class="ib-container-block">
                
                <div class="input-container">
                   <div class="input-group">
                       <span class="input-group-btn">
                           <span class="btn btn-danger btn-file">
                               Browse! <input type="file" name="file[]" class="file">
                           </span>
                       </span>
                       <input type="text" readonly placeholder="No Icon Seleted" class="form-control file_val">
                    </div>
                </div>

            </div>
        </div>
    </div><!--col-sm-4-->
    
</div><!--add-slide-->


@stop

@section('css')
   <!-- <link rel="stylesheet" href="/css/admin_custom.css">-->
   <link rel="stylesheet" href="{{ asset('css/simple-popup.css') }}">
@stop

@section('js')
<script type="text/javascript" src="{{ asset('js/simple-popup.js') }}"></script>
    <script> 
        $(document).ready(function(){
           $('#add_new').on('click', function(){
               length = $('.slider-images').find('.col-md-6').length;
               if(length%2==0){
                   $('.slider-images').append('<div class="clearfix"></div><br>');
               }
               $('.slider-images').append($('.add-slide').html());
           });
           
           $(document).on('change','.file', function(e){
               $(this).parents('.input-group').find('.file_val').val($(this).val());
           });
           
           $('.remove-image').on('click', function(e){
              $(this).parents('.col-md-6').remove(); 
           });
           
           $('.slider_form').on('submit', function(e){
               $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
               $('.cd-popup-trigger').click();
              
               $.ajax({
                    type:"POST",
                    url:"{{ route('submit.sliders') }}",
                    data: new FormData($('#slider_form')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data){
                        if(status!='error'){
                            setTimeout(function(){  
                                $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Updated Successfully..!!</span>');
                            },1000);
                            setTimeout(function(){  
                                window.location.href = '';
                             },2000);
                        }else{
                           $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                        } 
                    }

                });//ajax
               
               
           });
           
           
           
           
        });
    
    </script>
    
    
<!------ Simple Popup ----------> 
<a href="javascript:void(0);" class="cd-popup-trigger" data-backdrop="static" data-keyboard="false" style="display:none;">View Pop-up</a>

<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p></p>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup --> 
@stop
