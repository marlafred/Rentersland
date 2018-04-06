@extends('adminlte::page')

@section('title', 'Home Settings')

@section('content')

<section>
    <div class="row">
        <div class="col-md-3">
            @include('admin.home.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-info-circle"></i> About Us </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">

                    <form id="templateForm" role="form" onSubmit="return false;">
                        {{ csrf_field() }}
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Section Heading:</label>
                                <input type="text" name="headline" class="form-control"  placeholder="Enter Headline" value="{{ isset($about->headline)?$about->headline:'' }}" required/>
                            </div>
                        </div><!--col-sm-6-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Section Sub-Heading:</label>
                                <input type="text" name="sub_headline" class="form-control"  placeholder="Enter Sub-Headline" value="{{ isset($about->sub_headline)?$about->sub_headline:'' }}" required/>
                            </div>
                        </div><!--col-sm-6-->
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Section Tag Line:</label>
                                <input type="text" name="tagline" id="subject" class="form-control"  placeholder="Enter Tag Line" value="{{ isset($about->tagline)?$about->tagline:'' }}" required/>
                            </div>
                        </div><!--col-sm-12-->
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Left Side Image:</label>
                                <input type="file" id="aboutus_image"  name="aboutus_image"  accept="image/*" class="btn btn-default" />
                            </div>
                        </div><!--col-sm-6-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                @if($about->aboutus_image)
                                    <div class="input-container">
                                        <div class="input-group" style="width: 82%; float: left;">
                                           <span class="input-group-btn" style="position: absolute;right: 0;top: 0;">
                                                <button type="button" class="btn btn-danger remove-image"><i class="fa fa-trash"></i></button>
                                            </span>
                                       </div>
                                    </div>
                                    <img src="{{ asset('static/') }}/{{ $about->aboutus_image }}" style="width:350px; height: 150px;">
                                    <input type="hidden" name="about_image" value="{{ $about->aboutus_image }}">
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <label class="label-control"> Content:</label>
                            <textarea name="content" style="width:100%">{{ isset($about->content)?$about->content:'' }}</textarea>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <br>
                            <div class="response">&nbsp;</div>
                        </div><!--col-sm-6-->
                        <div class="col-sm-6 text-right">
                            <div class="form-group">
                                <label class="label-control"> &nbsp;</label> <br>
                                <input type="submit" value="Submit" class="btn btn-success" />
                            </div>
                        </div><!--col-sm-6-->
                    </form>

                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop


@section('js')
<script type="text/javascript" src="{{ asset('js/tiny_mce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tiny_mce/jquery.tinymce.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
	  tinymce.init({
		selector: 'textarea',
		height: 400,
		menubar: false,
		plugins: [
		  'advlist autolink lists link image charmap print preview anchor',
		  'searchreplace visualblocks code fullscreen',
		  'insertdatetime media table contextmenu paste code'
		],
		toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link image',
		content_css: '//www.tinymce.com/css/codepen.min.css'
	  });
	  
          $('.remove-image').on('click', function(e){
              $(this).parents('.col-sm-6').remove(); 
           });
	  
	  /**
	  	Save Template data
	  **/
	  $('#templateForm').on('submit', function(e){
                $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                $('.cd-popup-trigger').click();

                $.ajax({
                    type:"POST",
                    url:"{{ route('submit.aboutus') }}",
                    data: new FormData($('#templateForm')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data){
                            if(data=='success'){
                                setTimeout(function(){  
                                    $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Updated Successfully..!!</span>');
                                },1000);
                                setTimeout(function(){  
                                    window.location.href = '';
                                 },2000);
                            }else if(data=='error'){
                                $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                            }
                    },error: function(){
                            console.log('error');
                    }
                });
				
            });
	  
	});
	
 </script>
@stop