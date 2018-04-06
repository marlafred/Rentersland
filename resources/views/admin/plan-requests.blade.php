@extends('adminlte::page')

@section('title', 'Plan Requests By User ')

@section('content_header')
    <h1>Active Requests</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-title"><i class="fa fa-tripadvisor"></i> Plan Requests By User </h3> 
    
    <div class="box-body" style="overflow-x: auto; padding: 0;">
        
        <table class="table table-bordered table-striped" cellspacing="0" width="100%" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th width="20" style="text-align:center;">Sr#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Plan Date</th>
                    <th>Plan Time</th>
                    <th>Message</th>
                    <th>Rel. Listing</th>
                    <th>Listing Detail</th>
                    <th>Req Date</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $pos=1 ?>
                @if($requests)
                    @foreach ($requests as $req)
                    <tr>
                        <td><?php print $pos++ ?></td>
                        <td>{{ $req->sender_name }}</td>
                        <td>{{ $req->sender_email }}</td>
                        <td>{{ date('M j, Y', strtotime($req->plan_date)) }}</td>
                        <td>{{ ucfirst($req->plan_time) }}</td>
                        <td>{{ $req->sender_message }}</td>
                        <td>{{ $req->listing_id }}</td>
                        <td><a href="{{ route('detail.listing') }}/{{ $req->listing->slug }}"> {{ $req->listing->title }} </a></td>
                        <td>{{ date('M j, Y H:i a', strtotime($req->created_at)) }}</td>
                    </tr>

                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    </div>
</div>
	
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> //console.log('Hi!'); </script>
@stop
