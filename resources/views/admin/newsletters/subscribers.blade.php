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
                    <b><i class="fa fa-list"></i> Subscribers List </b>
                </div>
    
                <div class="box-body" style="padding: 3% 6%; overflow-x: auto;">
                    
                    <table class="table table-bordered table-striped" style="overflow-x: auto;">
                        <thead>
                            <tr>
                                <th width="20" style="text-align:center;">Sr#</th>
                                <th>Email</th>
                                <th>Date Subscribed</th>
                                <th>Newsletters</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pos=1; ?>
                            @if(count($subscribers) > 0)
                                @foreach ($subscribers as $subs)
                                <tr>
                                    <td><?php print $pos++ ?></td>
                                    <td>{{ $subs->email }}</td>
                                    <td>{{ date('M j Y, H:i a', strtotime($subs->created_at)) }}</td>
                                    <td><span class="badge">0</span></td>
                                    <td>
                                        <a href="javascript:void(0);" rel-id="{{ $subs->id }}" class="text-danger delete-this">
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