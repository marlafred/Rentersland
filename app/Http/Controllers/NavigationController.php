<?php

namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Navigation;

class NavigationController extends MyController 
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
    public function getMenu()
    {
        if($slug){
            $page =  Page::where('slug', $slug)->first();
            return view('page')->with('page', $page);
        }else{
            return view('errors.404');
        }
         
    }
    
    public function updateMenu(Request $request)
    {
        $deletedExistingMenu = Navigation::where('type', $request->type)->delete();
        
        if($request->page_id){
            foreach($request->page_id as $page){
                $nav = Navigation::where(array('page_id'=>$page, 'type'=>$request->type))->get();
                if(count($nav) > 0){
                    // Already Exist
                }else{
                    $navigation = new Navigation();
                    $navigation->type = $request->type;
                    $navigation->page_id = $page;
                    $navigation->save();
                }
                $status = 'success'; 
            }/*foreach*/
        }
        
        if($status == 'success'){
            return redirect()->back()->withInput()
            ->withErrors([
                'success' => ' Updated Successfully.',
            ]);
        } else {
            return redirect()->back()->withInput()
            ->withErrors([
                'success' => 'Error in updating.',
            ]);
        }
        
    }
    
    public function updatePositions(Request $request){
        $status = 'success'; 
        
        if($request->positions){
            $count = 1;
            $postitions = explode(',', $request->positions);
            foreach($postitions as $page){
                $nav = Navigation::where(array('page_id'=>$page, 'type'=>$request->type))->first();
                if($nav){
                    $navigation = Navigation::find($nav->id);
                    if($navigation){
                        $navigation->position = $count;
                        $navigation->save();
                        $status = 'success'; 
                        $count++;
                    }else{
                        $status = 'error';
                    }
                    
                }
            }
        }
        
        if($status == 'success'){
            return redirect()->back()->withInput()
            ->withErrors([
                'success' => ' Updated Successfully.',
            ]);
        } else {
            return redirect()->back()->withInput()
            ->withErrors([
                'success' => 'Error in updating.',
            ]);
        }
        
        
        
    }
    
}
