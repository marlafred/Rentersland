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
use Mailgun;

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

            $old_status = $user->doc_status;

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

                if (    $user->status == '1' && 
                        $user->doc_status == '1' && 
                        $old_status == '0' && 
                        $user->user_type == "Tenant"
                )
                {
                    $owners = User::where([
                        ['user_type', '!=', 'Tenant'],
                        ['status', '=', '0']
                    ])->get();

                    $owners_list = $owners->map(function ($owner) {
                        return collect($owner->toArray())
                            ->only(['first_name', 'email','last_name'])
                            ->all();
                    });

                    Mailgun::send('emails.batch', array('data' => $user->toArray()), function ($message) use($owners_list) {
                        
                        $message->from('Support@rentersland.com');

                        foreach ($owners_list as $owner ) {
                            
                            $message->to($owner['email'], $owner['first_name'].' '.$owner['last_name'], [
                                'name' => $owner['first_name'],
                            ])->subject('A Tenant has just been activated');    
                        }
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