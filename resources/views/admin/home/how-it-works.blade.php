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
                    <b><i class="fa fa-tasks"></i> How It Works </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                    <div class="row">
                        <form id="how-it-works" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="form-group col-sm-12">
                                <label>Box Heading</label>
                                <input type="text" class="form-control" name="title" value="{{ $works->title }}">
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group col-sm-12">
                                <label>Box Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ $works->description }}</textarea>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group col-sm-12 text-center">
                                <label>&nbsp;</label> <br>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                            
                            <input type="hidden" value="1" name="id">
                        </form>
                    </div><!--row-->
                    
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop

@section('js')
<script>
$(document).ready(function(){
   $('#how-it-works').on('submit', function(){
      $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
      $('.cd-popup-trigger').click();
                
      $.ajax({
         type:"POST",
         url:"{{ route('submit.howitworks') }}",
         data : $(this).serialize(),
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
                $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
          }
      }); 
   }); 
});
</script>
@stop