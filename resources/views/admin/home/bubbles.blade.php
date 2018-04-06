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
                    <b><i class="fa fa-info-circle"></i> Home Page Bubbles </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">

                    <form id="templateForm" role="form" onSubmit="return false;">
                        {{ csrf_field() }}
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Bubble1:</label>
                                <textarea class="form-control" name="bubble1">{{ isset($bubble->bubble1)?$bubble->bubble1:'' }}</textarea>
                            </div>
                        </div><!--col-sm-12-->
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Bubble2:</label>
                                <textarea class="form-control" name="bubble2">{{ isset($bubble->bubble2)?$bubble->bubble2:'' }}</textarea>
                            </div>
                        </div><!--col-sm-12-->               
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Bubble3:</label>
                                <textarea class="form-control" name="bubble3">{{ isset($bubble->bubble3)?$bubble->bubble3:'' }}</textarea>
                            </div>
                        </div><!--col-sm-12-->
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Bubble4:</label>
                                <textarea class="form-control" name="bubble4">{{ isset($bubble->bubble4)?$bubble->bubble4:'' }}</textarea>
                            </div>
                        </div><!--col-sm-12-->
                                          
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-control"> Bubble5:</label>
                                <textarea class="form-control" name="bubble5">{{ isset($bubble->bubble5)?$bubble->bubble5:'' }}</textarea>
                            </div>
                        </div><!--col-sm-12-->
                        
                        <div class="col-sm-6">
                            <label class="label-control"> Button Label </label>
                            <input type="text" class="form-control" value="{{ isset($bubble->btn_label)?$bubble->btn_label:'' }}" name="btn_label" />
                        </div><!--col-sm-6-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="label-control"> Button Link</label> <br>
                                <input type="text" class="form-control" value="{{ isset($bubble->btn_link)?$bubble->btn_link:URL::to('/') }}" name="btn_link" />
                                <p class="text-muted">{{ URL::to('/') }}</p>
                            </div>
                        </div><!--col-sm-6-->
                        
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

<script type="text/javascript">
	$(document).ready(function() {
	  
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
                    url:"{{ route('submit.bubbles') }}",
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