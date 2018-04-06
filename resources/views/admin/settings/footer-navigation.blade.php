@extends('adminlte::page')

@section('title', 'Settings')

@section('content')

<section style="padding: 0 6%;">
    <div class="row">
        <div class="col-md-3">
            @include('admin.settings.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-bars"></i> &nbsp; Footer Navigation </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                    @if (count($errors))
                        @foreach($errors->all() as $error)
                        <div class="col-sm-12">
                            <div class="alert alert-info"> <i class="fa fa-info-circle"></i> &nbsp; {{ $error }} </div>
                        </div>
                        @endforeach
                    @endif
                    <div class="col-md-4">
                        <form method="post" action="{{ route('submit.menu') }}">
                        {{ csrf_field() }}
                        <label class="label-default" style="width:100%; padding: 5%;">Available Options</label>
                        @if(isset($default))
                          @foreach($default as $page)
                             <?php $checked = '';  ?>
                             @if(in_array($page->id, $menu_array)) <?php $checked = 'checked';  ?> @endif
                             <div class="pretty p-image p-plain">
                                 <input type="checkbox" name="page_id[]" {{ $checked }} value="{{ $page->id }}" />
                                 <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
                                   <label>{{ $page->label }}</label>
                                 </div>
                             </div> 
                             <div class="clearfix"></div>
                          @endforeach
                        @endif
                        @if(isset($custom))
                          @foreach($custom as $page)
                            <?php $checked = '';  ?>
                             @if(in_array($page->id, $menu_array)) <?php $checked = 'checked';  ?> @endif
                             <div class="pretty p-image p-plain">
                                 <input type="checkbox" name="page_id[]" {{ $checked }} value="{{ $page->id }}" />
                                 <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
                                   <label>{{ $page->label }}</label>
                                 </div>
                             </div> 
                             <div class="clearfix"></div>
                          @endforeach
                        @endif
                       <br>
                       <input type="hidden" name="type" value="{{ $type }}">
                       <div class="form-group text-center">
                           <button type="submit" class="btn btn-primary"> Add Menu </button>
                       </div>
                      </form>
                    </div><!--col-md-4-->
                    
                    <div class="col-md-8 text-left" style="border-left: 1px solid #e5e5e5;">
                        <label class="label-default" style="width:100%; padding: 2%;">Set Positions</label>
                        <ul id="sortable">
                            @if(isset($navigation))
                            @foreach($navigation as $nav)
                                <li class="ui-state-default" id="{{ $nav->pages->id }}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> {{ $nav->pages->label }}</li>
                            @endforeach
                            @endif
                        </ul>
                        
                        <br>
                        <form method="post" action="{{ route('update.positions') }}">
                              {{ csrf_field() }}
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary"> Update Possitions </button>
                                <input type="hidden" name="positions" id="new_positions">
                                <input type="hidden" name="type" value="footer">
                            </div>
                        </form>
                    </div><!--col-md-6-->
                    
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
@stop
@section('js')
<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable({
      stop: function(e, ui) {
        $('#new_positions').val($('#sortable').sortable('toArray'));
      }
    });
    $( "#sortable" ).disableSelection();
  } );
  
</script>

@stop