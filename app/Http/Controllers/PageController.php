<?php

namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;

class PageController extends MyController 
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
    public function getPage($slug = null)
    {
        if($slug){
            $page =  Page::where('slug', $slug)->first();
            if($page){
                return view('page')->with('page', $page);
            }else{
                return view('errors.404');
            }
            
        }else{
            return view('errors.404');
        }
         
    }
    
}
