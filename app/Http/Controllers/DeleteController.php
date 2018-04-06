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
use App\Page;
use App\DocFile;


class DeleteController extends Controller
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
    
    public function deleteState(Request $request){
        $states = State::find($request->rel_id);
        if($states->delete()){
            echo 'success';
        }else{
            echo 'error';
        }
    }/*deleteState*/
    
    public function deletePage(Request $request){
        $page = Page::find($request->rel_id);
        if($page->delete()){
            echo 'success';
        }else{
            echo 'error';
        }
    }
    
    /**
     * Listings
    */
    
    public function deleteListing(Request $request){
        $listing = Listing::find($request->rel_id);
        $state_slug = $listing->state_slug; 
        if($listing->delete()){
           echo 'success';
            
           /*  $state_list = State::where('slug', $state_slug)->first();
            if($state_list){
                $list_count = $state_list->list_count - 1;
                if($list_count > 0){
                    State::where('slug', $state_slug)->update(['list_count' => $list_count]);
                }
            }/*$state_list*/
            
        }else{
            echo 'error';
        }
    }/*deleteListing*/
    
    public function deleteMultipleListing(Request $request){
        if($request->rec_ids){
            $status = '';
            foreach($request->rec_ids as $id){
                $listing = Listing::find($id);
                $state_slug = $listing->state_slug; 
                
                if($listing->delete()){
                    $status =  'success';
                    
                    /*$state_list = State::where('slug', $state_slug)->first();
                    if($state_list){
                        $list_count = $state_list->list_count - 1;
                        if($list_count > 0){
                            State::where('slug', $state_slug)->update(['list_count' => $list_count]);
                        }
                    }/*$state_list*/
                }else{
                    $status =  'error';
                }
                
            }/*foreach*/
            
            echo $status;
        }
    }/*deleteMultipleListing*/
    
    
    /**
     * Users
    */
    
    public function deleteUser(Request $request){
        $user = User::find($request->rel_id);
        if($user->delete()){
            echo 'success';
            
            $listings = Listing::where('user_id', $request->rel_id)->get();
            if(count($listings) > 0){
                foreach($listings as $list){
                    $listing = Listing::find($list->id);
                    $listing->delete();
                }
            }
            
        }else{
            echo 'error';
        }
    }/*deleteUser*/
    
    public function deleteFiles(Request $request){
        $user = DocFile::find($request->rel_id);
        if($user->delete()){
            echo 'success';
        }else{
            echo 'error';
        }
    }/*deleteUser*/
    
    public function deleteMultipleUser(Request $request){
        if($request->rec_ids){
            $status = '';
            foreach($request->rec_ids as $id){
                $user= User::find($id);
                
                if($user->delete()){
                    $status =  'success';
                }else{
                    $status =  'error';
                }
                
            }/*foreach*/
            
            echo $status;
        }
    }/*deleteMultipleUser*/
    
    
    
   
}