@extends('master')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Login</h1>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Admin</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
    <div class="overlay-box">
        <span class="step-label">Admin Login</span>
        <div class="content">
            @if (count($errors))
                @foreach($errors->all() as $error)
                    <div class="text-danger"> {{ $error }} </div>
                @endforeach
            @endif
            
                <form class="" method="POST" action="{{ route('admin.login.submit') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="text" class="form-control" placeholder="Email / Username" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" placeholder="Enter Password" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-clrd" name="submit" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
