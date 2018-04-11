<?php

namespace App\Http\Controllers;
use App\Listing;
use App\State;
use App\ApplyListing;
use Auth;
use App\Email;
use Mail;
use Illuminate\Http\Request;

class ListingController extends MyController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except'=>['getListings', 'listingDetail']]);
    }
    public function getListings($state=FALSE)
    {
        $list =  Listing::where(array('status'=>1))->orderBy('created_at', 'desc');
        if($state){
            $list->where('state_slug','=',$state);
        }
        $listings = $list->get();
        $sidebarListings = Listing::where(array('status'=>1))->orderBy('created_at', 'ASC')->limit(5)->get();
        
        $applied = array();
        if (!Auth::guest())
        {
            if(Auth::user()->user_type=='Tenant')
            {
                $app_listing = ApplyListing::where(array('tenant_id'=>Auth::id()))->get();
                foreach($app_listing as $list){
                    array_push($applied, $list->listing_id);
                }

            }
        }
        
        
        
        return view('listings', array('listings'=>$listings, 'applied'=>$applied, 'sidebarListings'=>$sidebarListings));
    }
    
    public function listingDetail($slug=FALSE){
        if($slug){
            $percentage = 0;
            $applied = array();
            if(Auth::guest()){
                $listing =  Listing::where(array('slug'=>$slug, 'status'=>1))->first();
            }else{
                $listing =  Listing::where(array('slug'=>$slug))->first();
                
                if(Auth::user()->user_type=='Tenant')
                {
                    $app_listing = ApplyListing::where(array('tenant_id'=>Auth::id()))->get();
                    foreach($app_listing as $list){
                        array_push($applied, $list->listing_id);
                    }
                    
                }
                
            }
            
            if($listing){
                $sidebarListings = Listing::where(array('status'=>1))->orderBy('created_at', 'ASC')->limit(5)->get();
                return view('listing-detail', array('listing'=>$listing, 'sidebarListings'=>$sidebarListings,'applied'=>$applied, 'percentage'=>$percentage));
            }else{
                return view('errors.404');
            }
                   
        }else{
            return view('errors.404');
        }
        
    }
    //3rd Email Function
    public function applyLinting()
    {
        extract($_POST);
        $listing = ApplyListing::where(array('listing_id'=>$listId, 'tenant_id'=>Auth::id()))->first();
        //echo "<pre>"; print_r($listing); echo "</pre>";
		
		$list=Listing::where('id',$listId)->first();
		
        if(count($listing)<1){
            $listing = new ApplyListing();
            $listing->tenant_id = Auth::id();
            $listing->listing_id = $listId;
            $listing->dealer_id = $dealer_id;
            if($listing->save())
            {	                 
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
				
				echo '<span class="text-success"><i class="fa fa-thumbs-up"></i> Request sent successfully ..!!</span>';
            }else
            {
                echo '<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Error in processing request ..!!</span>';
            }
        }else{
            echo '<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Already Applied ..!!</span>';
        }
    }/*applyLinting*/

    public function createListing($slug=FALSE)
    {
        
        $listing = array();
        if($slug)
        {
            $listing =  Listing::where(array('slug'=>$slug))->first();
        }
      
        if(Auth::user()->user_type=='Tenant')
        {
            return view('errors.404');
        }
        else
        {
            return view('create-listing', array('listing'=> $listing));
        }
        
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
            
            
            $targetPath = "public/uploads/".$file;
            
            if(imagejpeg($image, $targetPath)){
                $file_name = $file; 
            }

            /*
                    **Resize Images after upload
            */

            /*Small Thumbs*/
            $destination = "public/uploads/small_thumbs/".$file;
            $filename = $targetPath;
            $mode = 3;
            $width = 150;
            $height = 150;
            $this->resizeImage($filename, $destination, $mode, $width, $height);
            
            /*Large Thumbs*/
            $destination = "public/uploads/large_thumbs/".$file;
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
        
        $listing->user_id = Auth::id();
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
    
    
    public function deleteListing(Request $request){
        $listing = Listing::find($request->rel_id);
        $state_slug = $listing->state_slug; 
        if($listing->delete()){
           echo 'success';
        }else{
            echo 'error';
        }
    }/*deleteListing*/
    
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
