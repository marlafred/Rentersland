<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Auth;

class AdminLoginController extends MyController
{
    public function __construct(){
        parent::__construct();
        $this->middleware('guest:admin', ['except'=>['logout', 'adminLogout']]);
    }
	
    public function showLoginForm(){
	return view('auth.admin-login');
    }
	
    public function login(Request $request){
		
	$this->validate($request, array('password'=>'required|min:6'));
		
	if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            return redirect()->intended('admin.dashboard');
        }
        else if (Auth::guard('admin')->attempt(['username' => $request->input('email'), 'password' => $request->input('password')]))
        {
            return redirect()->intended('admin.dashboard');
        }
		
	return redirect()->back()->withInput()
        ->withErrors([
            'login' => 'Invalid Login Credentials.',
        ]);
	
    }
	
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->back();
    }
}
