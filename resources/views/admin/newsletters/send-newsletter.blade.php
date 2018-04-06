@extends('adminlte::page')

@section('title', 'Newsletters')

@section('content')

<section style="padding: 0 6%;">
    <div class="row">
        <div class="col-md-3">
            @include('admin.newsletters.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-envelope"></i> Newsletters </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" id="newsletter">
                                <option value=""> Select Newsletter</option>
                                @if($newsletters)
                                    @foreach ($newsletters as $newsletter)
                                    <option value="{{ $newsletter->id }}"> {{ $newsletter->subject }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div class="col-sm-6">
                            <button id="submit-newsletter" class="btn btn-success"> Send Newsletter </button>
                        </div>
                    </div><!--row-->
                    
                    <div class="col-sm-12">
                        <div class="response"></div>
                    </div>
                    
                    <br><br>
                    
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop

@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $('#submit-newsletter').on('click', function(e){
            if($('#newsletter').val()!=''){
                token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: '{{ route("send.newsletter") }}',
                        data: {newsletter:$('#newsletter').val(), _token: token},
                        type: 'POST',
                        success: function(data){
                            
                        }
                    });
            }else{
                alert("Select Newsletter First ..!!");
            }
        });
    });
</script>
@stop