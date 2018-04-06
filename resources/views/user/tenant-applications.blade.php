@extends('master')

@section('title', 'Tenants Listings')

@section('body')

    @include('user.sidebar')
    <!-- Content Area -->
    <div class="col-sm-9 dash-content">
        
        <div class="alert-box">
            <h4 class="heading"> <b> RENTERS ( {{ count($listings) }} )</b> </h4>
        </div>
        <!-- Listings -->
        <div class="col-sm-12 listing-items">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Tenant</td>
                        <td>Profile</td>
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
                            <td><strong>{{ $list->listing->users->first_name }} {{ $list->listing->users->last_name }}</strong></td>
                            <td><a href="{{ route('view.tenant.app') }}/{{ $list->tenant_id }}" class="text-danger"><i class="fa fa-eye"></i> View Profile</a></td>
                            <td>{{ date('M j Y, H:i a', strtotime($list->created_at)) }}</td>
                        </tr>
                        
                        @endforeach
                        @else
                        <tr><td colspan="8">No Record Found..!!</td></tr>
                    @endif

                </tbody>
            </table>
        </div>
        <!-- /Listings -->
        
    </div><!--dash-content-->

@stop