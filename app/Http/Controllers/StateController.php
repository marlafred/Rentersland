<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Auth;
use App\User;
class StateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $listing =  Listing::where('user_id','=',Auth::id())->count();
        
        $data = array('listings'=>$listing);
        return view('user.dashboard', $data);
    }

    public function listings()
    {
       $userListings =  User::find(Auth::id());
       $listings  = $userListings->listing;
       return view('user.listings', array('listings'=>$listings)); 
    }
    
    public function profile(){
       return view('user.profile');
    }
    
    public function changePassword(){
        return view('user.password');
    }

}
