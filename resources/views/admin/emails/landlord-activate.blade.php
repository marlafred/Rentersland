@extends('adminlte::page')

@section('title', 'Register Email Template')

@section('content')

<section style="padding: 0 6%;">
    <div class="row">
        <div class="col-md-3">
            @include('admin.emails.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-envelope"></i> New User Email Template </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                    <form id="addForm" role="form" onSubmit="return false;">
                        {{ csrf_field() }}
                         <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Subject </label>
                                <input type="text" name="subject" class="form-control" required placeholder="Write some subject" value="{{ isset($register->subject)?$register->subject:'' }}" />
                                
                            </div>
                        </div><!--col-sm-12-->
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Sender Email </label>
                                <input type="text" name="from_email" class="form-control" required placeholder="From Email" value="{{ isset($register->from_email)?$register->from_email:'info@rentersland.com' }}" />
                                
                            </div>
                        </div><!--col-sm-12-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Sender Name </label>
                                <input type="text" name="from_name" class="form-control" required placeholder="From Name" value="{{ isset($register->from_name)?$register->from_name:'RentersLand' }}" />
                                
                            </div>
                        </div><!--col-sm-12-->
                        <div class="clearfix"></div>
                        
                        <div class="col-sm-12">
                            <label class="label-control"> Content:</label>
                            <textarea name="content" style="width:100%">{{ isset($register->content)?$register->content:'' }}</textarea>
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
                        
                        <input type="hidden" value="landlord_activate" name="type">
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
                theme: 'modern',
		menubar: true,
		plugins: [
		  'advlist autolink lists link image charmap print preview anchor',
		  'searchreplace visualblocks code fullscreen',
		  'insertdatetime media table contextmenu paste code'
		],
		toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link image',
		content_css: '//www.tinymce.com/css/codepen.min.css'
	  });
	  
	  /*
            * Get Slug from Label
          */
          $('#label').on('change', function(){
              label = $(this).val();
              label = label.trim();
              slug = label.replace(/ /g,"-");
              slug = slug.toLowerCase();
              $('#slug').val(slug);
          });
         $('.remove-image').on('click', function(){
             $(this).parents('.col-sm-6').remove();
         });
          
	  /**
	  	Save Template data
	  **/
	  $('#addForm').on('submit', function(e){
                var data =  $(this).serialize();
                var element = $(this);
                $(this).find('.response').html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    type:"POST",
                    url:"{{ route('update.email') }}",
                    data: new FormData($('#addForm')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data){
                            if(data=='success'){
                                element.find('.response').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> Successfully Saved..!!</span>');
                                //$('#templateForm')[0].reset();
                            }else if(data=='error'){
                                element.find('.response').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error Occured..!!</span>');
                            }
                    },error: function(){
                            console.log('error');
                    }
                });
				
            });
	  
	});
	
 </script>
@stop