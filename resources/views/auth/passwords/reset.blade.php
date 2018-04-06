@extends('master')
@section('title', 'Reset Password')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Reset Password</h1>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Reset Password</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
    <div class="overlay-box">
        <span class="step-label">Reset Password</span>
        <div class="content">
            @if (count($errors))
                @foreach($errors->all() as $error)
                    <div class="text-danger"> {{ $error }} </div>
                @endforeach
            @endif
                    <form method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $email or old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" placeholder="New Password" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm New Password" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-clrd">
                                Reset Password
                            </button>
                            
                        </div>
                        
                        
                    </form>
                </div>
    </div>
</div>
@stop