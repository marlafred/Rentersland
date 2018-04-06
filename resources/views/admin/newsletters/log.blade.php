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
                    <b><i class="fa fa-clock-o"></i> Log Details </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                    
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop