@extends('adminlte::page')

@section('title', 'Static Pages')

@section('content')

<section>
   
    <div class="row">
        <div class="col-md-3">
            @include('admin.pages.sidebar')
        </div>
        <div class="col-md-9">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><i class="fa fa-file-o"></i> &nbsp; Static Pages List </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%;">
                  
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20" style="text-align:center;">Sr#</th>
                                <th>Label</th>
                                <th>Slug</th>
                                <th>Headline</th>
                                <th>Type</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pos=1 ?>
                            @if(isset($default))
                                @foreach ($default as $page)
                                <tr>
                                    <td><?php print $pos++ ?></td>
                                    <td>{{ $page->label }}</td>
                                    <td><A href="{{ url('/') }}/{{ $page->slug }}">{{ $page->slug }}</a></td>
                                    <td>{{ $page->headline }}</td>
                                    <td><span class="text-primary">Default</span></td>
                                    <td>{{ date('M j, Y', strtotime($page->created_at)) }}</td>
                                    <td>{{ date('M j, Y', strtotime($page->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ url('/') }}/{{ $page->slug }}" target="_blank" class="text-info">
                                                <i class="fa fa-eye"></i> View
                                        </a><br>
                                        @if($page->slug=='how-it-works' or $page->slug=='about-us' or $page->slug=='terms')
                                        <a href="{{ route('admin.add.pages') }}/{{ $page->slug }}" class="text-primary">
                                                <i class="fa fa-pencil-square"></i> Edit
                                        </a>
                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                            @endif
                            @if(isset($custom))
                                @foreach ($custom as $page)
                                <tr>
                                    <td><?php print $pos++ ?></td>
                                    <td>{{ $page->label }}</td>
                                    <td><a href="{{ url('/') }}/{{ $page->slug }}">{{ $page->slug }}</a></td>
                                    <td>{{ $page->headline }}</td>
                                    <td><span class="text-danger">Custom</span></td>
                                    <td>{{ date('M j, Y', strtotime($page->created_at)) }}</td>
                                    <td>{{ date('M j, Y', strtotime($page->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ url('/') }}/{{ $page->slug }}" target="_blank" class="text-info">
                                                <i class="fa fa-eye"></i> View
                                        </a><br>
                                        <a href="{{ route('admin.add.pages') }}/{{ $page->slug }}" class="text-primary">
                                                <i class="fa fa-pencil-square"></i> Edit
                                        </a><br>
                                        <a href="javascript:void(0);" rel-id="{{ $page->id }}" class="text-danger delete-this">
                                                <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>

                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div> <!--box-body-->
            </div>
            
        </div><!--col-md-9-->
    </div><!--row-->

</section>
@stop

@section('js')
    <script>
        $(document).ready(function(){
                        
           /*
            * Delete Page
           */ 
           $('.delete-this').on('click', function(e){
              var rel_id = $(this).attr('rel-id');
              token = $('meta[name="csrf-token"]').attr('content');
              if(confirm("Are you sure to delete this ??")){
                  $('.cd-popup-container').find('p').html('<i class="fa fa-spin fa-spinner fa-3x"></i>');
                  $('.cd-popup-trigger').click();
                    $.ajax({
                        url: '{{ route("delete.page") }}',
                        data: {rel_id:rel_id, _token: token},
                        type: 'POST',
                        success: function(data){
                            console.log(data);
                           if(data=='success'){
                             setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-success"><i class="fa fa-thumbs-up"></i> &nbsp; Deleted Successfully..!!</span>');
                             },1000);
                             setTimeout(function(){  
                                window.location.href = '';
                             },1500);
                           }else{
                            setTimeout(function(){  
                                 $('.cd-popup-container').find('p').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> &nbsp; Error occured..!!</span>');
                             },1000);
                                
                           }
                        }//success
                    });//ajax
              }
           }); 
        });
    </script>
@stop

