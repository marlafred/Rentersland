<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use App\State;
use Auth;
use App\User;
use App\TourRequest;
use App\SliderImages;
use App\Aboutus;
use App\Setting;
use App\PlanRequests;
use App\Email;
use Mail;

class UpdateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('auth:admin');
    }
    
    public function updateListingsStatus(Request $request){
        $status = $request->status;
        $featured = $request->featured;
        $list_id = $request->list_ids;
        
        $response = '';
        foreach($request->list_ids as $list_id){
            $listing = Listing::find($list_id);
            
            if($status!=''){
                $listing->status = $status;
            }
            if($featured!=''){
                $listing->featured = $featured;
            }
            if($listing->save()){
                $response = 'success';
            }else{
                $response = 'error';
            }
        }/*foreach*/
        
        echo $response;
    }/*updateListingsStatus*/
    
    // 2nd Email Function Point
    public function updateUserStatus(Request $request){
        $doc_status = ''; $status = '';
        
        if(isset($request->status)){
            $status = $request->status;
        }
        if(isset($request->doc_status)){
            $doc_status = $request->doc_status;
        }
        
        $response = '';
        foreach($request->user_ids as $user_id){
            $user = User::find($user_id);
            if($status!=''){
                $user->status = $status;
            }
            
            if($doc_status!=''){
                $user->doc_status = $doc_status;
            }
           
            if($user->save()){
                
                if($status=='1'){
                    $user = User::findOrFail($user_id);
                    //on active send email
                    $register = Email::where(array('type'=>$request->user_type))->first();
                    
                    $mail = Mail::send(['text'=>'emails.welcome'], array('data'=>$register), function($message) use($register, $user) {
                        $message->to($user->email, $user->last_name);
                        $message->subject($register->subject);
                        $message->from($register->from_email,$register->from_name);
                        $message->setContentType('text/html');
                    });
                    
                }
                
                
                $response = 'success';
            }else{
                $response = 'error';
            }
        }/*foreach*/
        
        echo $response;
    }
    
   
}