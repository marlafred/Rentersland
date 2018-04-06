<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Auth;

class UserLoginController extends MyController
{
    public function __construct(){
        parent::__construct();
        $this->middleware('guest')->except(['logout', 'userLogout']);
    }
    
    public function rentersLoginForm(){
	return view('auth.renters-login');
    }
    public function landlordLoginForm(){
	return view('auth.landlord-login');
    }
	
    public function login(Request $request){
		
	$this->validate($request, array( 'password'=>'required|min:6'));
        
	if (Auth::guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status'=>1] ))
        {
            return redirect()->route('user.dashboard');
        }
        elseif(Auth::guard('web')->attempt(['username' => $request->input('email'), 'password' => $request->input('password'), 'status'=>1] ))
        {
            return redirect()->route('user.dashboard');
        }
		
	return redirect()->back()->withInput()
        ->withErrors([
            'login' => 'Invalid Login Credentials.',
        ]);
	
    }
	
    public function userLogout(){
        Auth::guard('web')->logout();
        return redirect()->back();
    }
}
