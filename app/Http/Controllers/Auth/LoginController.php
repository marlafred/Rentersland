<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;

class LoginController extends MyController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except(['logout', 'userLogout']);
    }
    
    public function socialLogin($social)
    {
       return Socialite::driver($social)->redirect();
    }
    
    public function handleProviderCallback($social)
    {
       $userSocial = Socialite::driver($social)->user();
       $user = User::where(['email' => $userSocial->getEmail()])->first();
       if($user){
           Auth::login($user);
           return redirect()->action('HomeController@index');
       }else{
           return view('auth.tenant-register',['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
       }
    }
	
    public function username()
    {
        return 'username';
    }
   
}
