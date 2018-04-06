@extends('master')
@section('title', 'Forgot Password')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Reset Password Request</h1>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Forgot Password</a></li>
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
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            
                            <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                           
                        </div>

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-clrd">
                                Send Link
                            </button>
                            
                        </div>
                        
                        
                        <div class="form-group">
                                <a class="" href="{{ route('login') }}">
                                Oh, I remembered my password?
                                </a>
                        </div>
                        <div class="form-group">
                                <a class="" href="{{ route('register') }}">
                                Does not have account? Register here, its free
                                </a>
                        </div>
                        
                    </form>
                </div>
    </div>
</div>
@stop
