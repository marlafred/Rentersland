@extends('master')
@section('title', 'Landlord Login')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Landlord/Owner Login</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="">Login</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
    <div class="overlay-box">
        <span class="step-label">Landlord/Owner Login</span>
        <div class="content">
            @if (count($errors))
                @foreach($errors->all() as $error)
                    <div class="text-danger"> {{ $error }} </div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('user.login.submit') }}">
                {{ csrf_field() }}
                <div class="tp-login">
                  <a href="{{ url('login/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Login Using facebook </a>
                  <a href="{{ url('login/google') }}" class="btn btn-danger btn-google"><i class="fa fa-google"></i> Login Using Google </a>
                </div>
                <div class="clearfix"></div> 
                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                   <input id="email" type="text" class="form-control" placeholder="Email / Username" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-clrd" name="submit" value="Login" />
                </div>
                
                <div class="form-group">
                	<a class="" href="{{ route('password.request') }}">
                    	Forgot Your Password?
                	</a>
                </div>
                <div class="form-group">
                    <a class="text-danger prom-text" href="{{ route('register') }}" style="color:#d92228; font-size:18px;">
                        Don’t not have account? Register here, its free
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop