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
                        <div class="col-sm-4" style="height: 300px;">
                            <div class="box">
                                <div class="image text-center">
                                    <img src="{{ asset('static/') }}/{{ $works[1]->icon }}" class="img-responsive">
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="title text-center"><h5><b>{{ $works[1]->title }}</b></h5></div>
                                <div class="description">{{ $works[1]->description }}</div>
                                
                                <div class="form-group text-center">
                                    <a href="{{ route('admin.works-boxes') }}/{{ $works[1]->id }}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!--cols-m-4-->
                        
                        <div class="col-sm-4" style="height: 300px;">
                            <div class="box">
                                <div class="image text-center">
                                    <img src="{{ asset('static/') }}/{{ $works[2]->icon }}">
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="title text-center"><h5><b>{{ $works[2]->title }}</b></h5></div>
                                <div class="description">{{ $works[2]->description }}</div>
                                
                                <div class="form-group text-center">
                                    <a href="{{ route('admin.works-boxes') }}/{{ $works[2]->id }}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!--cols-m-4-->
                        
                        <div class="col-sm-4" style="height: 300px;">
                            <div class="box">
                                <div class="image text-center">
                                    <img src="{{ asset('static/') }}/{{ $works[3]->icon }}" class="img-responsive">
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="title text-center"><h5><b>{{ $works[3]->title }}</b></h5></div>
                                <div class="description">{{ $works[3]->description }}</div>
                                
                                <div class="form-group text-center">
                                    <a href="{{ route('admin.works-boxes') }}/{{ $works[3]->id }}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!--cols-m-4-->
                        
                    </div><!--row-->
                    
                    <div class="row">
                       @if(isset($data->title)) 
                       <h2 class="panel-heading">Edit Box</h2>
                        <form id="how-it-works" onsubmit="return false;">
                            {{ csrf_field() }}
                            <div class="form-group col-sm-12">
                                <label>Box Heading</label>
                                <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Box Icon</label>
                                <input type="file" id="icon"  name="icon"  accept="image/*" class="btn btn-default" />
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    @if($data->icon)
                                    <img src="{{ asset('static/') }}/{{ $data->icon }}" style="width:250px; height: 150px;">
                                    <input type="hidden" name="icon" value="{{ $data->icon }}">
                                    @endif
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group col-sm-12">
                                <label>Box Description</label>
                                <textarea name="description" rows="8" class="form-control">{{ $data->description }}</textarea>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group col-sm-12 text-center">
                                <label>&nbsp;</label> <br>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                            
                            <input type="hidden" value="{{ $data->id }}" name="id">
                        </form>
                        @endif
                    </div><!--row-->
                    
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('#how-it-works').on('submit', function(e){
        $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
        $('.cd-popup-trigger').click();

        $.ajax({
            type:"POST",
            url:"{{ route('submit.howitworks') }}",
            data: new FormData($('#how-it-works')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
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
                    $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
            }
        });

    });
});
</script>
@stop