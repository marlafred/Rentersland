@extends('master')
@section('body')
<div class="col-sm-12 clmn">
    <div class="overlay-box">
        <span class="step-label">Login</span>
        <div class="content">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" name="email" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-clrd" name="submit" value="submit" />
                </div>
            </form>
        </div>
    </div>
</div>
@stop