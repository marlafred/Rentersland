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
use App\Page;
use App\Setting;
use App\Newsletter;
use App\Navigation;
use App\Subscriber;
use App\Howitwork;
use App\DocFile;
use App\Bubble;
use App\Email;
use App\ApplyListing;
use Mail;

class AdminController extends Controller
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
   
    public function index()
    {
        $listings = Listing::all();
        $user =  User::count();
        $requests = TourRequest::count();
        $subscribers = Subscriber::count();
        $states = State::orderBy('town', 'ASC')->limit(8)->get();
        $data = array('listings'=>$listings, 'users'=>$user, 'requests'=>$requests,'states'=>$states,  'subscribers'=>$subscribers);
        
        return view('admin.dashboard', $data);
    }
    
    /**
     * Home
    */
    public function slider()
    {
        $slides = SliderImages::get();
        return view('admin.home.slider', array('slides'=>$slides));
    }
    public function howitWorks(){
        $data = Howitwork::find(1);
        return view('admin.home.how-it-works', array('works'=>$data));
    }/*howitWorks*/
    
    public function howitWorksBoxes($id = FALSE){
        $data = array();
        if($id){
            $data = Howitwork::find($id);
        }
        $works = Howitwork::all();
        
        return view('admin.home.works-boxes', array('works'=>$works, 'data'=>$data));
    }/*howitWorksBoxes*/
    
    public function aboutUs(){
        $about = Aboutus::first();
        return view('admin.home.about-us', array('about'=>$about));
    }
    
    public function bubbles(){
        $bubbles = Bubble::first();
        return view('admin.home.bubbles', array('bubble'=>$bubbles));
    }


    /**
     * Settings
    */
    public function settings(){
        $setting = Setting::first();
        return view('admin.settings.settings', array('setting'=>$setting));
    }
    public function  navigation(){
        $default = Page::where(array('type'=>'default'))->get();
        $custom = Page::where(array('type'=>'custom'))->get();
        $navigation = Navigation::where('type', 'main')->orderBy('position', 'ASC')->limit(7)->get();
        
        $menu_array = array();
        if(count($navigation) > 0){
            foreach ($navigation as $nav){
                if(isset($nav->pages->id)){
                    array_push($menu_array, $nav->pages->id);
                }
                
            }
        }
        
        $data = array('default'=>$default, 'custom'=>$custom, 'navigation'=>$navigation, 'menu_array'=>$menu_array); 
        return view('admin.settings.navigation',  $data)->with(['message' => 'You can select maximum seven available options']);
    }/*navigation*/
    
    public function  footerNavigation($slug=false){
        $default = Page::where(array('type'=>'default'))->get();
        $custom = Page::where(array('type'=>'custom'))->get();
        $navigation = Navigation::where('type', $slug)->orderBy('position', 'ASC')->get();
        
        $menu_array = array();
        if(count($navigation) > 0){
            foreach ($navigation as $nav){
                array_push($menu_array, $nav->pages->id);
            }
        }
        
        $data = array('default'=>$default, 'custom'=>$custom, 'type'=>$slug, 'navigation'=>$navigation, 'menu_array'=>$menu_array); 
        return view('admin.settings.footer-navigation',  $data);
    }/*navigation*/
    
    public function states(){
        $states = State::orderBy('town', 'ASC')->get();
        $data = array('states'=>$states); 
        return view('admin.settings.states', $data);
    }
    
    /**
     * Newsletters
    */
    public function newsletters(){
        $newsletters = Newsletter::orderBy('created_at', 'desc')->get();
        return view('admin.newsletters.newsletters', array('newsletters' => $newsletters));
    }
    public function createNewsletter($id=FALSE){
        if($id){
            $newsletter =  Newsletter::where('id', $id)->first();
            return view('admin.newsletters.create-newsletter', array('newsletter'=>$newsletter));
        }else{
            return view('admin.newsletters.create-newsletter');
        }
        
    }
    public function subscribers(){
        $subscribers = Subscriber::all();
        return view('admin.newsletters.subscribers', array('subscribers'=>$subscribers));
    }
    public function sendNewsletter(){
        $data = array('name'=>"Virat Gandhi");
   
       /* $mail = Mail::send(['text'=>'emails.welcome'], $data, function($message) {
                    $message->to('saeed.walisys@gmail.com', 'Tutorials Point')->subject
                       ('Welcome to Renters Land');
                    $message->from('info@rentersland.com','Renters Land');
                }); 
                */
        
        $subscribers = Subscriber::all();
        $newsletters =  Newsletter::orderBy('created_at', 'desc')->get();
        
        return view('admin.newsletters.send-newsletter', array('newsletters' => $newsletters, 'subscribers'=>$subscribers));
    }
    public function log(){
        return view('admin.newsletters.log');
    }
    
    /*
     * Pages
    */
    public function pages(){
        $default = Page::where(array('type'=>'default'))->get();
        $custom = Page::where(array('type'=>'custom'))->get();
        $data = array('default'=>$default, 'custom'=>$custom); 
        return view('admin.pages.pages', $data);
    }
    public function addPages($slug=FALSE){
        if($slug){
            $page =  Page::where('slug', $slug)->first();
            return view('admin.pages.add-page', array('page'=>$page));
            
        }else{
            return view('admin.pages.add-page');
        }
    }
    
    public function listings()
    {
       $listings =  Listing::orderBy('created_at', 'desc')->get();
       return view('admin.listings', array('listings'=>$listings));
    }
    
    
    public function createListings($slug=FALSE)
    {
       $listing = array();
       if($slug)
       {
            $listing =  Listing::where(array('slug'=>$slug))->first();
       }
       return view('admin.create-listings', array('listing'=> $listing)); 
    }
    
    public function submitListing(){
        extract($_POST);
        
        $file_name = ''; $schedual_startdate = ''; $schedual_enddate = ''; $pets = '';
        
        if($id!=''){
            $listing = Listing::find($id);
        }else{
            $listing = new Listing;
        }
        
        if($_FILES['featured_image']['tmp_name']){
            
            $sourcePath = $_FILES['featured_image']['tmp_name'];       // Storing source path of the file in a variable
            $image = imagecreatefromstring(file_get_contents($sourcePath));
            $exif = exif_read_data($sourcePath);
            if(!empty($exif['Orientation'])) {
                switch($exif['Orientation']) {
                    case 1: // nothing
                    break;

                    case 2: // horizontal flip

                    break;

                    case 3: // 180 rotate left
                        $image = imagerotate($image,180,0);
                    break;

                    case 4: // vertical flip

                    break;

                    case 5: // vertical flip + 90 rotate right
                        $image = imagerotate($image,-90,0);
                    break;

                    case 6: // 90 rotate right
                       $image = imagerotate($image,-90,0);
                    break;

                    case 7: // horizontal flip + 90 rotate right
                        $image = imagerotate($image,-90,0);
                    break;

                    case 8:    // 90 rotate left
                        $image = imagerotate($image,90,0);
                    break;	

                }
            }
            
            $file = $_FILES['featured_image']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $file = 	time().rand(1,1000).$File_Ext;
            
            $targetPath = public_path()."uploads/".$file;
            
            if(imagejpeg($image, $targetPath)){
                $file_name = $file; 
            }

            /*
                    **Resize Images after upload
            */

            /*Small Thumbs*/
            $destination = public_path()."uploads/small_thumbs/".$file;
            $filename = $targetPath;
            $mode = 3;
            $width = 150;
            $height = 150;
            $this->resizeImage($filename, $destination, $mode, $width, $height);
            
            /*Large Thumbs*/
            $destination = public_path()."uploads/large_thumbs/".$file;
            
            $filename = $targetPath;
            $mode = 3;
            $width = 370;
            $height = 270;
            $this->resizeImage($filename, $destination, $mode, $width, $height);
            
        }elseif($exist_featured!=''){
            $file_name = $exist_featured;
        } 
        
        if($schedual_startdate!=''){
            $schedual_startdate = date('Y-m-d', strtotime($schedual_startdate));
        }
         
        if($schedual_enddate!=''){
            $schedual_enddate = date('Y-m-d', strtotime($schedual_enddate));
        }
        
        if($pets){
            $pets = implode(',',$pets);
        }
      
        $statename = $state;
        $state = strtolower($state);
        $state_slug = str_replace(' ', '-', $state);
        
        $cityname = $city;
        $city = strtolower($city);
        $city_slug = str_replace(' ', '-', $city);
        
        if($id!=''){
        }else{
            $listing->user_id = Auth::id();
        }
        
        $listing->title = $title;
        $listing->lat = $lat;
        $listing->lng = $lng;
        $listing->country = $country;
        $listing->state = $state;
        $listing->state_slug = $state_slug;
        $listing->city_slug = $city_slug;
        $listing->address = $address;
        $listing->street_no = $street_no;
        $listing->unit = $unit;
        $listing->street_name = $street_name;
        $listing->city = $city;
        $listing->zipcode = $zipcode;
        $listing->price = $price;
        $listing->property_type = $property_type;
        $listing->sqr_feet = $sqr_feet;
        $listing->bedrooms = $bedrooms;
        $listing->bathrooms = $bathrooms;
        $listing->partial_bathrooms = $partial_bathrooms;
        $listing->description = $description;
        $listing->pets = $pets;
        //$listing->leasing_fees = isset($leasing_fees)?$leasing_fees:'';
        //$listing->lease_terms = $lease_terms;
        
        $listing->contact_name = $contact_name;
        $listing->contact_email = $contact_email;
        $listing->contact_phone = $contact_phone;
        $listing->contact_mobile = $contact_mobile;
        
        if($schedual_startdate!=''){
            $listing->schedual_startdate = $schedual_startdate;
        }
       // $listing->schedual_time = $schedual_time;
        if($schedual_enddate){
            $listing->schedual_enddate = $schedual_enddate;
        }
        $listing->notes = $notes;
        $listing->featured_image = $file_name;
        //$listing->weekdays = implode(',', $weekdays);
        
        $listing->save();

        $ammenties_array = array();
        if($amenities){
           foreach($amenities as $amen){
            array_push($ammenties_array, array('name'=>$amen));
          }
        }
        $listing->amenities()->delete();
        if(count($ammenties_array)>0){
          
          $listing->amenities()->createMany($ammenties_array);  
        }
      
        $ammenties_building_array = array();
        if($building_amenties){
           foreach($building_amenties as $amen){
            array_push($ammenties_building_array, array('name'=>$amen));
          }
        }
        $listing->buildingamenties()->delete();
        if(count($ammenties_building_array)>0){
          $listing->buildingamenties()->createMany($ammenties_building_array);  
        }
      
        $images_array  = array();
         if($listing_images!=''){
             trim($listing_images, '#');
            $images = explode('#',$listing_images);
            if($images){
                foreach($images as $img){
                    if($img){
                        array_push($images_array, array('image'=>$img));
                    }
                }
            }
            
        }
        
         if(isset($exist_images) and count($exist_images) > 0){
            foreach($exist_images as $img){
                if($img){
                    array_push($images_array, array('image'=>$img));
                }
            }
        }/*isset*/ 
        
        $listing->listingimages()->delete();
        if(count($images_array)){
            $listing->listingimages()->createMany($images_array);  
        }
       
        $last_id = $listing->id;
        /** Craete and update slug as well **/
        $title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);
        $slug = str_replace(' ', '-', $title).'-'.$last_id; 
        $listing = Listing::find($last_id);
        $listing->slug = $slug;
        $listing->save();
        
        $state_list = State::where('town_slug', $city_slug)->first();
        if($state_list){
            $list_count = $state_list->list_count + 1;
            State::where('town_slug', $city_slug)->update(['list_count' => $list_count]);
        }else{
            $state = new State();
            $state->state = $statename;
            $state->state_slug = $state_slug;
            
            $state->town = $cityname;
            $state->town_slug = $city_slug;
            
            $state->list_count = 1;
            $state->save();
        }
        
        if($id==''){
            /// Send Email to admin on new listings
            $register = Email::where(array('type'=>'listing_notify'))->first();
            if($register){
                $mail = Mail::send(['text'=>'emails.welcome'], array('data'=>$register), function($message) use($register) {
                    $message->to($register->admin_email, 'RentersLand');
                    $message->subject($register->subject);
                    $message->from($register->from_email,$register->from_name);
                    $message->setContentType('text/html');
                });
            }
     
        }
      
        if($last_id and $slug!=''){
            echo json_encode(array('status'=>'success', 'slug'=>$slug));
        }else{
           echo json_encode(array('status'=>'errors', 'slug'=>''));
        }
       
    }/*submitListing*/
    
    public function adminListings()
    {
       $listings =  Listing::where(array('user_id'=>Auth::id()))->orderBy('created_at', 'desc')->get();
       return view('admin.listings', array('listings'=>$listings)); 
    
    }
    
    public function listingDetail($slug=FALSE){
        if($slug){
            $percentage = 0;
            $listing =  Listing::where(array('slug'=>$slug))->first();
            $setting = Setting::first();
            $navigation = Navigation::where('type', 'main')->orderBy('position', 'ASC')->get();
            $company = Navigation::where('type', 'company')->orderBy('position', 'ASC')->get();
            $support = Navigation::where('type', 'support')->orderBy('position', 'ASC')->get();
            $short_links = Navigation::where('type', 'short-links')->orderBy('position', 'ASC')->get();
            
            if($listing){
                $sidebarListings = Listing::where(array('status'=>1))->orderBy('created_at', 'ASC')->limit(5)->get();
                return view('listing-detail', array('listing'=>$listing, 'setting'=>$setting, 'navigation'=>$navigation,'company'=>$company, 'support'=>$support, 'short_links'=>$short_links, 'sidebarListings'=>$sidebarListings, 'percentage'=>$percentage));
            }else{
                return view('errors.404');
            }
                   
        }else{
            return view('errors.404');
        }
    }
    
    
    public function planRequests(){
        $requests = TourRequest::orderBy('created_at', 'DESC')->get();
        $data = array('requests'=>$requests); 
        return view('admin.plan-requests', $data);
    }
    
    public function applicants(){
        
        $applicants = ApplyListing::orderBy('created_at', 'DESC')->get();
        return view('admin.applicants', array('applicants'=>$applicants));
       
    }

    public function submitStats(Request $request){
       if($request->town==''){
            return redirect()->back()->withInput()
                ->withErrors([
                    'error' => 'Town is Empty...',
                ]);
        }
        
        $state = new State();
        
        $state_name = strtolower($request->state);
        $state_slug = str_replace(' ', '-', $state_name);
        
        $town_name = strtolower($request->town);
        $town_slug = str_replace(' ', '-', $town_name);
        
         $town_list = State::where('town_slug', $town_slug)->first();
        if($town_list){
            return redirect()->back()->withInput()
                ->withErrors([
                    'error' => 'Already Exist..!!',
            ]);
        }else{
            $state->state =  $request->state;
            $state->state_slug =  $state_slug;
            $state->town =  $request->town;
            $state->town_slug =  $town_slug;
            
            if($state->save()){
                return redirect()->back()->withInput()
                ->withErrors([
                    'success' => 'Added Successfully.',
                ]);
            }else{
                return redirect()->back()->withInput()
                ->withErrors([
                    'error' => 'Error Occured, Try Again...',
                ]);
            }
        }
        
        
    
    }/*submitStats*/

    public function submitHowitWorks(Request $request){
        extract($_POST);
        
        $filename = '';
        if(isset($_FILES['icon']['tmp_name'])){
            $sourcePath = $_FILES['icon']['tmp_name'];       // Storing source path of the file in a variable
            $file = $_FILES['icon']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $files = 	time().rand(1,1000).$File_Ext;	
            $targetPath = "public/static/".$files; // Target path where file is to be stored
            if(move_uploaded_file($sourcePath,$targetPath)){
                $filename = $files; 
            }
        }else if(isset($about_image) and $about_image!=''){
            $filename = $icon; 
        } 
        
        $data = Howitwork::find($id);
        $data->title = $title;
        $data->icon = $filename;
        $data->description = $description;
        
        if($data->save()){
            echo 'success';
        }else{
            echo 'error';
        }
    }/*submitHowitWorks*/

    public function users(){
        $user =  User::where('user_type', '!=','Tenant')->orWhereNull('user_type')->orderBy('created_at', 'DESC')->get();
        return view('admin.users', array('users'=>$user)); 
    }
    
    public function tenants(){
        $user =  User::where(array('user_type'=>'Tenant'))->orderBy('created_at', 'DESC')->get();
        return view('admin.tenant.tenants', array('users'=>$user)); 
    }

    
    /* edit user  */

    public function editUser($id)
    {
        $topStates = State::orderBy('town', 'ASC')->get();
        $user = User::findOrFail($id);
        return view('admin.edit-user',array('user'=>$user, 'states'=>$topStates));
    }

    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);
        
        $towns = '';
        if(isset($request->towns) and $request->towns!=''){
            $towns = implode(',',$request->towns);
        }
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        
        $user->personal_info = $request->personal_info;
        $user->address = $request->address;
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->street_name = $request->street_name;
        
        $user->bedrooms = isset($request->bedrooms)?$request->bedrooms:'';
        $user->towns = $towns;
        $user->pets = isset($request->pets)?$request->pets:'';
        
        $user->company = isset($request->company)?$request->company:'';
        
        if($user->save()){
            return redirect()->back();
        }else{
            return redirect()->back()->withInput()
            ->withErrors([
                'error' => 'An Error Occured..!!',
            ]);
        }
        
        
        
    }

    public function tenantApplications(){
        $userApp =  User::where(array('user_type'=>'Tenant'))->get();
        return view('admin.tenant-applications', array('userApp'=>$userApp)); 
    }
    
    public function tenatFiles($user_id = FALSE){
        $data = array();
        if($user_id){
            $files =  DocFile::where(array('user_id'=>$user_id))->orderBy('created_at', 'DESC')->get();
            $data = array('user_id'=>$user_id, 'files'=>$files);
            
            return view('admin.tenant.tenant-files', $data);
        }else{
            return view('errors.404');
        }
        
    }


    public function viewApplication($username=FALSE){
        if($username){
            $userApp =  User::where(array('username'=>$username))->first();
            
            if($userApp){
                $data = array(
                            'about' => $userApp->about,
                            'residence'=> $userApp->residence,
                            'occupation'=> $userApp->occupation,
                            'info'=> $userApp->info,
                            'reference'=> $userApp->reference,
                            'finance'=> $userApp->finance,
                            'loan'=> $userApp->loan,
                         );
                
                return view('admin.tenant.application-view', $data);
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
        
    }
    
    public function editApplication($username=FALSE){
        if($username){
            $userApp =  User::where(array('username'=>$username))->first();
            
            if($userApp){
                $data = array(
                            'about' => $userApp->about,
                            'residence'=> $userApp->residence,
                            'occupation'=> $userApp->occupation,
                            'info'=> $userApp->info,
                            'reference'=> $userApp->reference,
                            'finance'=> $userApp->finance,
                            'loan'=> $userApp->loan,
                         );
                
                return view('admin.tenant.application-edit', $data);
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
        
    }
    
    /*
     * emails
     */
    public function emailRegister(){
        $register = Email::where(array('type'=>'register'))->first();
        return view('admin.emails.register', array('register'=>$register));
    }
    
    public function emailListing(){
        $listing = Email::where(array('type'=>'listing'))->first();
        return view('admin.emails.listing', array('register'=>$listing));
    }
    
    public function emailRegisterNotify(){
        $register = Email::where(array('type'=>'register_notify'))->first();
        return view('admin.emails.register-notify', array('register'=>$register));
    }
    
    public function emailListingNotify(){
        $listing = Email::where(array('type'=>'listing_notify'))->first();
        return view('admin.emails.listing-notify', array('register'=>$listing));
    }
    
    public function emailRenterActivate(){
        $listing = Email::where(array('type'=>'renter_activate'))->first();
        return view('admin.emails.renter-activate', array('register'=>$listing));
    }
    
    public function emailLandlordActivate(){
        $listing = Email::where(array('type'=>'landlord_activate'))->first();
        return view('admin.emails.landlord-activate', array('register'=>$listing));
    }
    
    
    /*
     * profile
     */
    
    public function profile(){
       return view('admin.profile');
    }
    
    public function submitSlider(Request $request){
        
        SliderImages::truncate();
        $status = '';
        if($request->exist_images){
            foreach($request->exist_images as $image){
                $slides = new SliderImages();
                $slides->image = $image;
                if($slides->save()){
                    $status = 'success';
                }else{
                    $status = 'error';
                }
            }
        }
       
        if(isset($_FILES['file']['name'][0])){
            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                $file_name = '';
                $slides = new SliderImages();
                
                $sourcePath = $_FILES['file']['tmp_name'][$i];       // Storing source path of the file in a variable
                $file = $_FILES['file']['name'][$i];
                $File_Ext = substr($file, strrpos($file,'.'));
                $files = 	time().rand(1,1000).$File_Ext;	
                $targetPath = "public/slides/".$files; // Target path where file is to be stored
                if(move_uploaded_file($sourcePath,$targetPath)){
                    $file_name = $files; 
                }
                if($file_name!=''){
                    $slides->image = $file_name;
                    
                    if($slides->save()){
                        $status = 'success';
                    }else{
                        $status = 'error';
                    }
                }
            }/*for*/
            
        } 
        
        echo $status;
        
    }/*submitSlider*/ 
    
    
    public function submitNewsletter(Request $request){
        if($request->id!=''){
            $newsletter = Newsletter::find($request->id);
        }else{
            $newsletter = New Newsletter();
        }
        $newsletter->subject = $request->subject;
        $newsletter->content = $request->content;
        
        if($newsletter->save()){
            echo 'success';
        }else{
            echo 'error';
        }
        
    }/*submitNewsletter*/
    
    public function submitBubbles(Request $request){
        
        Bubble::truncate();
        
        $bubble = new Bubble();
        
        $bubble->bubble1 = $request->bubble1;
        $bubble->bubble2 = $request->bubble2;
        $bubble->bubble3 = $request->bubble3;
        $bubble->bubble4 = $request->bubble4;
        $bubble->bubble5 = $request->bubble5;
        
        $bubble->btn_link = $request->btn_link;
        $bubble->btn_label = $request->btn_label;
        
        if($bubble->save()){
            echo 'success';
        }else{
            echo 'error';
        }
        
    }/*submitBubbles*/

    

    public function submitAboutus(Request $request){
        $filename = '';
        Aboutus::truncate();
        extract($_POST);
        
        if($_FILES['aboutus_image']['tmp_name']){
            $sourcePath = $_FILES['aboutus_image']['tmp_name'];       // Storing source path of the file in a variable
            $file = $_FILES['aboutus_image']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $files = 	time().rand(1,1000).$File_Ext;	
            $targetPath = "public/static/".$files; // Target path where file is to be stored
            if(move_uploaded_file($sourcePath,$targetPath)){
                $filename = $files; 
            }
        }else if(isset($about_image) and $about_image!=''){
            $filename = $about_image; 
        } 
        
        $about = new Aboutus();
        $about->headline = $headline;
        $about->sub_headline = $sub_headline;
        $about->tagline = $tagline;
        $about->content = $content;
        $about->aboutus_image = $filename;
        
        if($about->save()){
            echo 'success';
        }else{
            echo 'error';
        }
    }/*submitAboutus*/
    
    public function submitSettings(Request $request){
        $filename = '';
        Setting::truncate();
        extract($_POST);
        
        if($_FILES['logo']['tmp_name']){
            $sourcePath = $_FILES['logo']['tmp_name'];       // Storing source path of the file in a variable
            $file = $_FILES['logo']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $files = 	time().rand(1,1000).$File_Ext;	
            $targetPath = "public/static/".$files; // Target path where file is to be stored
            if(move_uploaded_file($sourcePath,$targetPath)){
                $filename = $files; 
            }
        }else if(isset($logo_image) and $logo_image!=''){
            $filename = $logo_image; 
        } 
        
        if($facebook!=''){
            $facebook = $this->parseURL($facebook);
        }
        if($twitter!=''){
            $twitter = $this->parseURL($twitter);
        }
        if($instagram!=''){
            $instagram = $this->parseURL($instagram);
        }
        if($google_plus!=''){
            $google_plus = $this->parseURL($google_plus);
        }
        
        $setting = new Setting();
        $setting->title = $title;
        $setting->address = $address;
        $setting->lat = $lat;
        $setting->lng = $lng;
        $setting->email = $email;
        $setting->logo = $filename;
        $setting->contact = $contact;
        $setting->facebook = $facebook;
        $setting->twitter = $twitter;
        $setting->instagram = $instagram;
        $setting->google_plus = $google_plus;
        $setting->copyright = $copyright;
        $setting->logo_position = $logo_position;
        
        
        
        if($setting->save()){
            echo 'success';
        }else{
            echo 'error';
        }
        
    }/*submitSettings*/
    
    public function SubmitTenatFiles(){
        $filename = '';
        extract($_POST);
        
        if($_FILES['file']['tmp_name']){
            $sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
            $file = $_FILES['file']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $files = 	time().rand(1,1000).$File_Ext;	
            $targetPath = "public/static/".$files; // Target path where file is to be stored
            if(move_uploaded_file($sourcePath,$targetPath)){
                $filename = $files; 
            }
        }else if(isset($image) and $image!=''){
            $filename = $image; 
        } 
        
        $doc = new DocFile();
        
        $doc->doc_title = $doc_title;
        $doc->doc_description = $doc_description;
        $doc->user_id = $user_id;
        $doc->file_name = $filename;
        
        if($doc->save()){
            echo 'success';
        }else{
            echo 'error';
        }
    }/*SubmitTenatFiles*/

    

    private function parseURL($input){
        $input = trim($input, '/');
        if (!preg_match('#^http(s)?://#', $input)) {
            $input = 'http://' . $input;
        }
        $urlParts = parse_url($input);
        $domain = preg_replace('/^www\./', '', $urlParts['host']);
        return $input;
    }
    
    public function submitPages(Request $request){
        
        $left_sidebar_image_file = ''; $right_sidebar_image_file = '';
        extract($_POST);
        
        if($_FILES['left_sidebar_image']['tmp_name']){
            $sourcePath = $_FILES['left_sidebar_image']['tmp_name'];       // Storing source path of the file in a variable
            $file = $_FILES['left_sidebar_image']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $files = 	time().rand(1,1000).$File_Ext;	
            $targetPath = "public/static/".$files; // Target path where file is to be stored
            if(move_uploaded_file($sourcePath,$targetPath)){
                $left_sidebar_image_file = $files; 
            }
        }else if(isset($about_image) and $about_image!=''){
            $filename = $about_image; 
        } 
        
        if($_FILES['right_sidebar_image']['tmp_name']){
            $sourcePath = $_FILES['right_sidebar_image']['tmp_name'];       // Storing source path of the file in a variable
            $file = $_FILES['right_sidebar_image']['name'];
            $File_Ext = substr($file, strrpos($file,'.'));
            $files = 	time().rand(1,1000).$File_Ext;	
            $targetPath = "public/static/".$files; // Target path where file is to be stored
            if(move_uploaded_file($sourcePath,$targetPath)){
                $right_sidebar_image_file = $files; 
            }
        }else if(isset($about_image) and $about_image!=''){
            $right_sidebar_image_file = $about_image; 
        } 
        if($page_id!=''){
            $about = Page::find($page_id);
        }else{
            $about = new Page();
        }
        
        $about->label = $label;
        $about->slug = $slug;
        $about->headline = $headline;
        $about->content = $content;
        $about->left_sidebar_image = $left_sidebar_image_file;
        $about->right_sidebar_image = $right_sidebar_image_file;
        
        if($about->save()){
            echo 'success';
        }else{
            echo 'error';
        }
        
    }/*submitPages*/
    
    
    public function sendUserNewsletter(Request $request){
        /*echo $request->newsletter;
        
        $data = array('name'=>"Virat Gandhi");
   
        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Basic Testing Mail');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });*/
    }
    
    public function updateEmail(Request $request){
        $register = Email::where(array('type'=>$request->type))->first();
        if(count($register) > 0){
        }else{
            $register = New Email();
        }
        $register->subject = $request->subject;
        $register->content = $request->content;
        $register->from_email = $request->from_email;
        $register->from_name = $request->from_name;
        $register->type = $request->type;
        $register->admin_email = $request->admin_email;
        
        if($register->save()){
            echo 'success';
        }else{
            echo 'error';
        }
    }/*updateRegister*/
    
    
    //helper function to resize an image based on input, output and size
    function resizeImage($input, $output, $mode, $w, $h = 0)
    {
        switch($this->getMimeType($input))
        {
            case "image/png":
                $img = ImageCreateFromPng($input);
                break;
            case "image/gif":
                $img = ImageCreateFromGif($input);
                break;
            case "image/jpeg":
            default:
                $img = ImageCreateFromJPEG ($input);
                break;
        }

        $image['sizeX'] = imagesx($img);
        $image['sizeY'] = imagesy($img);
        switch ($mode){
        case 1: //Quadratic Image
            $thumb = imagecreatetruecolor($w,$w);
            if($image['sizeX'] > $image['sizeY'])
            {
                imagecopyresampled($thumb, $img, 0,0, ($w / $image['sizeY'] * $image['sizeX'] / 2 - $w / 2),0, $w,$w, $image['sizeY'],$image['sizeY']);
            }
            else
            {
                imagecopyresampled($thumb, $img, 0,0, 0,($w / $image['sizeX'] * $image['sizeY'] / 2 - $w / 2), $w,$w, $image['sizeX'],$image['sizeX']);
            }
            break;

        case 2: //Biggest side given
            if($image['sizeX'] > $image['sizeY'])
            {
                $thumb = imagecreatetruecolor($w, $w / $image['sizeX'] * $image['sizeY']);
                imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
            }
            else
            {
                $thumb = imagecreatetruecolor($w / $image['sizeY'] * $image['sizeX'],$w);
                imagecopyresampled($thumb, $img, 0,0, 0,0, imagesx($thumb),imagesy($thumb), $image['sizeX'],$image['sizeY']);
            }
            break;
        case 3; //Both sides given (cropping)
            $thumb = imagecreatetruecolor($w,$h);
            if($h / $w > $image['sizeY'] / $image['sizeX'])
            {
                imagecopyresampled($thumb, $img, 0,0, ($image['sizeX']-$w / $h * $image['sizeY'])/2,0, $w,$h, $w / $h * $image['sizeY'],$image['sizeY']);
            }
            else
            {
                imagecopyresampled($thumb, $img, 0,0, 0,($image['sizeY']-$h / $w * $image['sizeX'])/2, $w,$h, $image['sizeX'],$h / $w * $image['sizeX']);
            }
            break;

        case 0:
            $thumb = imagecreatetruecolor($w,$w / $image['sizeX']*$image['sizeY']);
            imagecopyresampled($thumb, $img, 0,0, 0,0, $w,$w / $image['sizeX']*$image['sizeY'], $image['sizeX'],$image['sizeY']);
            break;
    }        

        if(!file_exists($output)) imagejpeg($thumb, $output, 90);
    }


    //helper function to get the mime type of a file
    function getMimeType($file)
    {
        $idx = explode( '.', $file );
            $count_explode = count($idx);
            $idx = strtolower($idx[$count_explode-1]);
            
            $mimet = array( 
                    // images
                    'png' => 'image/png',
                    'jpe' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'jpg' => 'image/jpeg',
                    'gif' => 'image/gif',
                    'bmp' => 'image/bmp',
                    'ico' => 'image/vnd.microsoft.icon',
                    'tiff' => 'image/tiff',
                    'tif' => 'image/tiff',
                    'svg' => 'image/svg+xml',
                    'svgz' => 'image/svg+xml',
                );
           
            if (isset( $mimet[$idx] )) {
                return $mimet[$idx];
            } else {
                return 'application/octet-stream';
            }
    }

}