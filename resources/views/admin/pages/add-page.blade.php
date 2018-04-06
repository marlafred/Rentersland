@extends('adminlte::page')

@section('title', 'Home Settings')

@section('content')

<section>
    <div class="row">
        <div class="col-md-3">
            @include('admin.pages.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-plus"></i>&nbsp; Create New Page </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">

                    <form id="addForm" role="form" onSubmit="return false;">
                        {{ csrf_field() }}
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Page Label:</label>
                                @if(isset($page->slug) and $page->slug=='how-it-works')
                                <input type="text" name="label" class="form-control" readonly="" id="label"  placeholder="e.g Privacy Policy" value="{{ isset($page->label)?$page->label:'' }}" required/>
                                @else
                                <input type="text" name="label" class="form-control" id="label"  placeholder="e.g Privacy Policy" value="{{ isset($page->label)?$page->label:'' }}" required/>
                                @endif
                                
                            </div>
                        </div><!--col-sm-6-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Page Slug:</label>
                                <input type="text" readonly="" name="slug" id="slug" class="form-control"  placeholder="privacy-policy" value="{{ isset($page->slug)?$page->slug:'' }}" required/>
                            </div>
                        </div><!--col-sm-6-->
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Page Heading:</label>
                                <input type="text" name="headline" id="headline" class="form-control"  placeholder="See What We Are Offering" value="{{ isset($page->headline)?$page->headline:'' }}" />
                            </div>
                        </div><!--col-sm-12-->
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Left Sidebar Image:</label>
                                <input type="file" id="left_sidebar_image"  name="left_sidebar_image"  accept="image/*" class="btn btn-default" />
                            </div>
                        </div><!--col-sm-6-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                @if(isset($page->left_sidebar_image) and $page->left_sidebar_image!='')
                                    <div class="input-container">
                                        <div class="input-group" style="width: 82%; float: left;">
                                           <span class="input-group-btn" style="position: absolute;right: 0;top: 0;">
                                                <button type="button" class="btn btn-danger remove-image"><i class="fa fa-trash"></i></button>
                                            </span>
                                       </div>
                                    </div>
                                    <img src="{{ asset('static/') }}/{{ $page->left_sidebar_image }}" style="width:350px; height: 150px;">
                                    <input type="hidden" name="left_sidebar_image" value="{{ $page->left_sidebar_image }}">
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Right Sidebar Image:</label>
                                <input type="file" id="right_sidebar_image"  name="right_sidebar_image"  accept="image/*" class="btn btn-default" />
                            </div>
                        </div><!--col-sm-6-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                @if(isset($page->right_sidebar_image) and $page->right_sidebar_image!='')
                                    <div class="input-container">
                                        <div class="input-group" style="width: 82%; float: left;">
                                           <span class="input-group-btn" style="position: absolute;right: 0;top: 0;">
                                                <button type="button" class="btn btn-danger remove-image"><i class="fa fa-trash"></i></button>
                                            </span>
                                       </div>
                                    </div>
                                    <img src="{{ asset('static/') }}/{{ $page->right_sidebar_image }}" style="width:350px; height: 150px;">
                                    <input type="hidden" name="right_sidebar_image" value="{{ $page->right_sidebar_image }}">
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <label class="label-control"> Content:</label>
                            <textarea name="content" style="width:100%">{{ isset($page->content)?$page->content:'' }}</textarea>
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
                        
                        <input type="hidden" value="{{ isset($page->id)?$page->id:'' }}" name="page_id">
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
                    url:"{{ route('submit.pages') }}",
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