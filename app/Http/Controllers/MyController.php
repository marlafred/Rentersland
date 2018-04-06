<?php 
namespace App\Http\Controllers;
use App\State;
use App\Listing;
use App\Setting;
use App\Navigation;
use App\Page;
use View;

class MyController extends Controller {
    public function __construct()
    {
        $navigation = Navigation::where('type', 'main')->orderBy('position', 'ASC')->get();
        $company = Navigation::where('type', 'company')->orderBy('position', 'ASC')->get();
        $support = Navigation::where('type', 'support')->orderBy('position', 'ASC')->get();
        $short_links = Navigation::where('type', 'short-links')->orderBy('position', 'ASC')->get();
        
        $topStates = State::orderBy('town', 'ASC')->get();
        $setting = Setting::first();
        
        $terms =  Page::where('slug', 'terms')->first();
        
        $data = array('navigation'=>$navigation,'states'=>$topStates, 'company'=>$company, 'support'=>$support, 'short_links'=>$short_links, 'setting'=>$setting, 'terms'=>$terms);
        
        View::share($data);
    }
}
