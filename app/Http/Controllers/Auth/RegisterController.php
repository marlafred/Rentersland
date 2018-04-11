<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Email;
use Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends MyController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:30|unique:users',
            'password'=>'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%@]).*$/|confirmed',
            'password_confirmation'=>'required|min:6',
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $towns = '';
        if(isset($data['towns']) and $data['towns']!=''){
            $towns = implode(',',$data['towns']);
        }
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'phone_number' => $data['phone_number'],
            'user_type' => $data['user_type'],
            'status' => $data['status'],

            /*Dealer*/
            'company' => isset($data['company'])?$data['company']:'',
            'market_type' => isset($data['market_type'])?$data['market_type']:'',
            /*Tenant*/
            'bedrooms' => isset($data['bedrooms'])?$data['bedrooms']:'',
            'towns' => $towns,
            'pets' => isset($data['pets'])?$data['pets']:'',
            
        ]);
        
        $register = Email::where(array('type'=>'register'))->first();
        if($register){
            $file = 'emails.dealers-email';
            if($data['email']=='Tenant'){
                $file = 'emails.renters-email';
            }
            
            $mail = Mail::send(['text'=>$file], array('data'=>array()), function($message) use($register, $data) {
                $message->to($data['email'], $data['last_name']);
                $message->subject($register->subject);
                $message->from($register->from_email,$register->from_name);
                $message->setContentType('text/html');
            });

            //First Mail Function Point
        }

        if ( $user->user_type == 'Tenant' ) {
            $data = array(
                'full_name' => $user->first_name.' '.$user->last_name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
            );

            Mail::send('emails.tenant_signup_notify', array('data' => $data), function($message) {
                $subject = 'A Tenant Just Registered Account';
                $message->to('Support@rentersland.com');
                $message->subject($subject);
                $message->from('notification@rentersland.com', 'Notification');
            });
        }
        
        return $user;
         
        
    }
}
