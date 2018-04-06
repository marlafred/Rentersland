<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Auth;
use App\State;
use App\ApplyListing;

class SearchController extends MyController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('auth');
    }

    public  function homeSearch(Request $request){
        $state = $request->state;
        
        $state = strtolower($request->state);
        $state_slug = str_replace(' ', '-', $state);
        
        $city = strtolower($request->city);
        $city_slug = str_replace(' ', '-', $city);
        
        $list =  Listing::orderBy('created_at', 'desc');
        if($state!=''){
            $list->where('state_slug', '=', $state_slug  ) OR  $list->where('city', '=', $city ) ;
        }
        if($city!=''){
            $list->where('city_slug', '=', $city_slug);
        }
        
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
        
        $listings =   $list->get();
        $sidebarListings = Listing::where(array('status'=>1))->orderBy('created_at', 'ASC')->limit(5)->get();
        return view('listings', array('listings'=>$listings, 'applied'=>$applied,  'sidebarListings'=>$sidebarListings));
    }
    
    public function ajaxSearch(Request $request)
    {
        $price = $request->price;
        $property_type = $request->property_type;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        
        $list =  Listing::orderBy('created_at', 'desc');
        if($price!=''){
            $price = $price * 100;
            $list->where('price', '<=', $price);
        }
        if($property_type !=''){
            $list->where('property_type', '=', $property_type);
        }
        if($bedrooms!=''){
            $list->where('bedrooms', '=', $bedrooms);
        }
        if($bathrooms!=''){
            $list->where('bathrooms', '=', $bathrooms);
        }
        $listings =   $list->get();
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
        
        return view('templates.listings.listing-left', array('listings'=>$listings, 'applied'=>$applied, 'sidebarListings'=>$sidebarListings));
        
    }
    
    public function commonSearch(Request $request)
    {
        
        $price = $request->price;
        $property_type = $request->property_type;
        $bedrooms = $request->bedrooms;
        
        $list =  Listing::orderBy('created_at', 'desc');
        if($price!=''){
            $price = $price * 100;
            $list->where('price', '<=', $price);
        }
        if($property_type !=''){
            $list->where('property_type', '=', $property_type);
        }
        if($bedrooms!=''){
            $list->where('bedrooms', '=', $bedrooms);
        }
       
        $listings =   $list->get();
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
        
        return view('listings', array('listings'=>$listings,'applied'=>$applied,  'sidebarListings'=>$sidebarListings));
    }
    
    public function maps()
    {
        return view('maps');
    }
}
