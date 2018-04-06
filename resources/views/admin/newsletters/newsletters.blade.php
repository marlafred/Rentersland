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
    
                <div class="box-body" style="padding: 3% 6%; overflow-x: auto;">
                    
                    <table class="table table-bordered table-striped"  style="overflow-x: auto;">
                        <thead>
                            <tr>
                                <th width="20" style="text-align:center;">Sr#</th>
                                <th>Subject</th>
                                <th>Log</th>
                                <th>Date Updated</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pos=1 ?>
                            @if($newsletters)
                                @foreach ($newsletters as $newsletter)
                                <tr>
                                    <td><?php print $pos++ ?></td>
                                    <td>{{ $newsletter->subject }}</td>
                                    <td><span class="badge">0</span></td>
                                    <td>{{ date('M j Y, H:i a', strtotime($newsletter->updated_at)) }}</td>
                                    <td>{{ date('M j Y, H:i a', strtotime($newsletter->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('admin.create.newsletter') }}/{{ $newsletter->id }}" rel-id="{{ $newsletter->id }}" class="text-primary">
                                                <i class="fa fa-pencil"></i> Edit 
                                        </a> | 
                                        <a href="javascript:void(0);" rel-id="{{ $newsletter->id }}" class="text-danger delete-this">
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