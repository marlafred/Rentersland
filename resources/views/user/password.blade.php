@extends('master')

@section('title', 'Change Password')

@section('body')

@if(Auth::user()->user_type=='Tenant')
@include('user.rental-sidebar')
@else
@include('user.sidebar')
@endif

<!-- Content Area -->
<div class="col-sm-9 dash-content">
    <div class="col-sm-12 clmn">
        <div class="alert-box">
            <h4 class="heading"> <b>Change Password</b> </h4>
            <div class="content">
                <div class="row edit-profile">
                    @if (count($errors))
                    @foreach($errors->all() as $error)
                    <div class="text-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success"><i class="fa fa-thumbs-up"></i> {{session('success')}}</div>
                    @endif

                    <form method="POST" action="{{ route('user.update.password') }}">
                        {{ csrf_field() }}
                        <div class="form-group col-sm-12">
                            <label>Current Password</label>
                            <input id="old_password" type="password" placeholder="Current Password" class="form-control" name="old_password" required autofocus>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>New Password</label>
                            <input id="password" type="password" placeholder="New Password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Confirm Password</label>
                            <input id="password_confirmation" type="password" placeholder="Re-type Password" class="form-control" name="password_confirmation" required="">
                        </div>
                        <div class="form-group col-sm-12 text-right">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn btn-clrd" name="submit" value="Change Password" />
                        </div>
                        <div class="clearfix"></div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!--dash-content-->
@stop