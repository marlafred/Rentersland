@extends('master')
@section('title', 'Create Account')
@section('body')

<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Create an Account</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="javascript:void(0);">Register</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
    <div class="overlay-box">
        <span class="step-label">Register</span>
        <div class="content">
            @if(isset($email))
            <div class="col-sm-12">
                <div class="text-danger"> 
                    Account does not exist with <span class="text-primary"> {{ $email }} </span>.
                    Provide information below to create new account.
                </div>
                <div class="clearfix"></div>
            </div>
            @endif
            <form class="" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                        <select name="user_type" class="form-control" id="user_type" required>
                            <option value="">What Describes you best</option>
                            <option value="Owner">Owner</option>
                            <option value="Landlord">Landlord</option>
                            <option value="Agent">Agent</option>
                            <option value="Building Manager">Building Manager</option>
                        </select>

                        @if ($errors->has('user_type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        @if(isset($name))
                            <input id="first_name" type="text" placeholder="First Name *" class="form-control" name="first_name" value="{{ $name }}" required autofocus>
                        @else
                            <input id="first_name" type="text" placeholder="First Name *" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                        @endif
                        
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <input id="last_name" type="text" placeholder="Last Name *" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        @if(isset($email))
                            <input id="email" type="email" placeholder="Email Address *" class="form-control" name="email" value="{{ $email }}" required>
                        @else
                            <input id="email" type="email" placeholder="Email Address *" class="form-control" name="email" value="{{ old('email') }}" required>
                        @endif
                        
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input id="username" type="text" placeholder="Username *" class="form-control" name="username" value="{{ old('username') }}" required>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>    
                 
                <div class="col-sm-6">    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" placeholder="Password *" class="form-control" name="password" required>
                        <p class="text-muted"> Password must contain a number, a chracter & a capital</p>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input id="password-confirm" type="password" placeholder="Confirm Password"  class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="clearfix"></div>    
                
                <div class="non-tanant">
                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <input id="phone_number" type="text" placeholder="Phone Number" class="form-control" name="phone_number" value="{{ old('phone_number') }}">

                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                            <input id="company" type="text" placeholder="Company/Organization (if any)" class="form-control" name="company" value="{{ old('company') }}">

                            @if ($errors->has('company'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div> 
                
                <div class="col-sm-6" style="display:none;">
                    <div class="form-group{{ $errors->has('market_type') ? ' has-error' : '' }}">
                        <input id="market_type" type="text" placeholder="Market Type" class="form-control" name="market_type" value="{{ old('market_type') }}">

                        @if ($errors->has('market_type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('market_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="clearfix"></div> 
                
                <div class="col-sm-12">
                    <div class="pretty p-image p-plain" style="width: 90px;">
                      <input type="checkbox" name="terms" value="yes" @if(old('terms') == 'yes') checked @endif required />
                      <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
                            <label>I agree to </a></label>
                      </div>
                    </div>
                    <a href="javascript:void(0);"  data-toggle="modal" data-target="#terms" style="position:  relative; top: -3px; color: #052fc6;" >Terms & Conditions</a>
                </div>
                
                <div class="clearfix"></div> 
                <div class="col-sm-8">
                    <div class="form-group">
                        <br>
                        <a class="text-danger" href="{{ route('landlord.login') }}" style="color:#d92228; font-size:18px;" >
                            Already have an account? Login here
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="form-group">
                        <input type="submit" class="btn btn-clrd" name="submit" value="Register Now" />
                    </div>
                </div>
                <div class="clearfix"></div> 
                <hr>
                <div class="tp-login">
                  <a href="{{ url('login/facebook') }}" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Register Using facebook </a>
                  <a href="{{ url('login/google') }}" class="btn btn-danger btn-google"><i class="fa fa-google"></i> Register Using Google </a>
                </div>

                <input type="hidden" name="status" value="0">

            </form>
        </div>
    </div>
</div>


 <!-- Modal -->
  <div class="modal fade" id="terms" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ $terms->label }}</h4>
        </div>
        <div class="modal-body">
            <?php print  $terms->content ?>
        </div>
      </div>
      
    </div>
  </div>



@stop

@section('script')
<link rel="stylesheet" href="{{ asset('css/pretty-checkbox.min.css') }}">
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<script>
    $(document).ready(function(){
       $('#user_type').on('change', function(e){
           if($(this).val()=='Tenant'){
               $('.non-tanant').hide();
           }else{
               $('.non-tanant').show();
           }
       }); 
    });
</script>
@stop
