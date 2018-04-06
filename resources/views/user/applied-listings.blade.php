@extends('master')

@section('title', 'Listings Applied')

@section('body')

@include('user.rental-sidebar')
<!-- Content Area -->
<div class="col-sm-9 dash-content">
        <div class="alert-box">
            <h4 class="heading"> <b> Listings Applied ( {{ count($listings) }} )</b> </h4>
        </div>
            <!-- Listings -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Address</td>
                        <td>Price</td>
                        <td>Date Applied</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @if(count($listings) > 0)
                    @foreach($listings as $list)
                    <tr>
                        <td><?php print $count++; ?></td>
                        <td>
                            @foreach ($list->listing->listingimages as $images)
                            @if ($loop->first)
                            <img src="{{ asset('uploads/'.$images->image) }}" width="60" />
                            @endif
                            @endforeach
                        </td>
                        <td><strong><a href="{{ route('detail.listing') }}/{{ $list->listing->slug }}">{{ $list->listing->title }}</a></strong></td>
                        <td>{{$list->listing->address}}</td>
                        <td>${{ $list->listing->price }}</td>
                        <td>{{ date('M j Y, H:i a', strtotime($list->created_at)) }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr><td colspan="8">No Record Found..!!</td></tr>
                    @endif
                </tbody>
            </table>
            <!-- /Listings -->
        
</div><!--dash-content-->
@stop