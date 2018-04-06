@extends('adminlte::page')

@section('title', 'Plan Requests By User ')

@section('content_header')
    <h1>Active Requests</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-title"><i class="fa fa-tripadvisor"></i> Listings Applied </h3> 
    
    <div class="box-body" style="overflow-x: auto; padding: 0;">
        
        <table class="table table-bordered table-striped" class="display" cellspacing="0" width="100%" style="overflow-x: auto;">
            <thead>
                <tr>
                    <th width="20" style="text-align:center;">Sr#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>App. Profile</th>
                    <th>Date Applied</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=1 ?>
                @if($applicants)
                    @foreach ($applicants as $list)
                    <tr>
                        <td><?php print $count++; ?></td>
                        <td>
                            @foreach ($list->listing->listingimages as $images)
                            @if ($loop->first)
                            <img src="{{ asset('uploads/small_thumbs/'.$images->image) }}" width="60" />
                            @endif
                            @endforeach
                        </td>
                        <td><strong><a href="{{ route('detail.listing') }}/{{ $list->listing->slug }}">{{ $list->listing->title }}</a></strong></td>
                        <td>{{$list->listing->address}}</td>
                        <td>${{ $list->listing->price }}</td>
                        <td><a href="{{route('edit.user', $list->tenant_id)}}" class="text-primary"> Profile</a></td>   
                        <td>{{ date('M j Y, H:i a', strtotime($list->created_at)) }}</td>
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
