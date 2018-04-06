<?php

namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use App\Listing;
use Auth;
use App\SliderImages;
use App\Aboutus;
use App\TourRequest;
use App\Contact;
use App\Subscriber;
use App\Howitwork;
use App\Page;
use App\Bubble;
use Mail;
use App\Email;
use App\User;

class HomeController extends MyController 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $slides = SliderImages::get();
        $about = Aboutus::first();
        $works = Howitwork::all();
        $featuredListings = Listing::where(array('featured'=>1, 'status'=>1))->orderBy('created_at', 'DESC')->limit(6)->get();
        
        $bubble = Bubble::first();
        $data = array(
                    'slides'=>$slides,
                    'about'=>$about,
                    'featuredListings'=>$featuredListings,
                    'works'=>$works,
                    'bubble'=>$bubble,
                );
        return view('home', $data);
    }
    
    public function contactUs(){
        return view('contact-us');
    }
    
    public function howItWorks(){
        $page =  Page::where('slug', 'how-it-works')->first();
        return view('how-it-works')->with('page', $page);
    }
    
    public function submitContactForm(Request $request){
       $contact = new Contact();
       $contact->sender_name = $request->sender_name;
       $contact->sender_email = $request->sender_email;
       $contact->sender_phone = $request->sender_phone;
       $contact->subject = $request->subject;
       $contact->message = $request->message;
       
       
       if($contact->save()){
            return redirect()->back()->withInput()
            ->withErrors([
                'success' => ' Thankyou for contact, our team will contact you soon.',
            ]);
        } else {
            return redirect()->back()->withInput()
            ->withErrors([
                'success' => ' Thankyou for contact, our team will contact you soon.',
            ]);
        }
    }
    
    public function submitNewsletterForm(Request $request){
        $count = Subscriber::where(array('email'=>$request->email))->count();
        if($count > 0){
            echo '<span class="text-danger" style="color:#FFF;">Email Address Already Subscribed!</span>';
        }else{
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;

            if($subscriber->save()){
                echo '<span class="text-success" style="color:#FFF;">Subscribed Successfully!</span>';
            }else{
                echo '<span class="text-danger">Error in processing request!</span>';
            }
        }
        
    }
    
    public function termsAndConditions(){
        $page =  Page::where('slug', 'terms')->first();
        return view('terms')->with('page', $page);
    }    

    public function apply()
    {
        if(Auth::user()){
            return redirect()->route('user.dashboard');
        }else{
            return view('apply');
        }
        
    }
    
    public function submitPlan(Request $request){
        
        $list=Listing::where('id',$request->listing_id)->first();
        
        $plan = new TourRequest();
		
        $plan->plan_date = date('Y-m-d', strtotime($request->plan_date));
        $plan->plan_time = $request->plan_time;
        $plan->sender_name = $request->sender_name;
        $plan->sender_email = $request->sender_email;
        $plan->sender_phone = $request->sender_phone;
        $plan->sender_message = $request->sender_message;
        $plan->listing_id = $request->listing_id;
        $plan->dealer_id = $request->dealer_id;
        $plan->sender_id = $request->sender_id;
        
        $plan->save();
        if($plan->id){
            
            $mail1 = Mail::send(['text'=>'emails.plan-tour-email'], array('data'=>$list), function($message) use($list) {
                    $message->to('support@rentersland.com');
                    $message->subject($list->title);
                    $message->setContentType('text/html');
                });	
			
				$mail = Mail::send(['text'=>'emails.plan-tour-email'], array('data'=>$list), function($message) use($list) {
                    $message->to($list->contact_email);
                    $message->subject($list->title);
                    $message->setContentType('text/html');
                });	
            
            echo 'success';
			
        }else{
            echo 'error';
        }
    }
    public function maps()
    {
        return view('maps');
    }



    /*  Tenant Store method   */

    public function tenantRegisterStore(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:6',
            'bedrooms' => 'required',
            'towns' => 'required',
            'pets' => 'required',
        ]);


        $user = new User();

        $user->first_name =$request->first_name;
        $user->last_name =$request->last_name;
        $user->email =$request->email;
        $user->phone_number =$request->phone_number;
        $user->username =$request->username;
        $user->password =bcrypt($request->password);
        $user->bedrooms =$request->bedrooms;
        $user->towns =implode(',',$request->towns);
        $user->pets =$request->pets;
        $user->user_type='Tenant';
        $user->status='0';

        if($user->save()){
//            return redirect()->back()->withSuccess('Updated Successfully..!!');

            return view('user.success');
        }else{
            return redirect()->back()->withInput()
                ->withErrors([
                    'error' => 'An Error Occured..!!',
                ]);
        }
    }


    /* tenant Register form  */
    public function tenantRegister()
    {
        if(Auth::user()){
            return redirect()->route('user.dashboard');
        }else{
            return view('auth.tenant-register');
        }
        

    }
}
