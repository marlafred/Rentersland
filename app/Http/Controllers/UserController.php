<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Auth;
use App\User;
use Hash;
use App\TenantAbout;
use App\TenantResidence;
use App\TenantOccupation;
use App\TenantInfo;
use App\TenantReference;
use App\TenantFinance;
use App\TenantLoan;
use App\TourRequest;
use App\ApplyListing;
use App\DocFile;
use App\ReplyRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends MyController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

        if(Auth::user()->user_type=='Tenant')
        {
            $listings = ApplyListing::where(array('tenant_id'=>Auth::id()))->get();
            $requests = TourRequest::where(array('sender_email'=>Auth::user()->email))->orWhere('sender_id', Auth::id())->get();
            $files =  DocFile::where(array('user_id'=>Auth::id()))->orderBy('created_at', 'DESC')->get();
            
            $data = array('listings'=>count($listings), 'requests'=>count($requests), 'files'=>count($files));
            
            return view('user.rental-dashboard', $data);
            
        }else{
            $listing =  Listing::where('user_id','=',Auth::id())->count();
            $requests =  TourRequest::where('dealer_id','=',Auth::id())->count();
            $applies = ApplyListing::where(array('dealer_id'=>Auth::id()))->count();
            
            $data = array('listings'=>$listing, 'requests'=>$requests, 'applies'=>$applies);
            return view('user.dashboard', $data);
        }
    }

    public function listings()
    {

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

       $userListings =  User::find(Auth::id());
       $listings  = $userListings->listing;
       return view('user.listings', array('listings'=>$listings)); 
    }
    
    public function listingsApplied()
    {

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

        if(Auth::user()->user_type=='Tenant')
        {
            $listings = ApplyListing::where(array('tenant_id'=>Auth::id()))->get();
            return view('user.applied-listings', array('listings'=>$listings));
        }else{
            return view('errors.404');
        }
         
    }
    
    public function tenantApplications()
    {

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

        if(Auth::user()->user_type=='Tenant')
        {
            return view('errors.404');
        }else
        {
           $listings = ApplyListing::where(array('dealer_id'=>Auth::id()))->get();
            return view('user.tenant-applications', array('listings'=>$listings));
        }
         
    }


    public function tenantAlert(){
        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }else
        {
           return redirect('dashboard');
        }

    }

    public function viewFiles(){
        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }else
        {
           $files =  DocFile::where(array('user_id'=>Auth::id()))->orderBy('created_at', 'DESC')->get();
           $data = array('files'=>$files);
           return view('user.tenant-files', $data);
        }
    }

    public function profile(){

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

       return view('user.profile');
    }
    
    public function planRequests(){

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

        $requests = TourRequest::orderBy('created_at', 'DESC');
        if(Auth::user()->user_type=='Tenant'){
            $requests->where(array('sender_email'=>Auth::user()->email))->orWhere('sender_id', Auth::id());
        }else{
            $requests->where(array('dealer_id'=>Auth::id()));
        }
        $requests = $requests->get();
         
        $data = array('requests'=>$requests); 
        if(Auth::user()->user_type=='Tenant'){
            return view('user.tenant-plan-requests', $data);
        }else{
            return view('user.plan-requests', $data);
        }
        
    }
    
    public function viewApplication($id=FALSE){

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

        if($id){
            $userApp =  User::where(array('id'=>$id))->first();
            
            if($userApp){
               /* $data = array(
                            'about' => $userApp->about,
                            'residence'=> $userApp->residence,
                            'occupation'=> $userApp->occupation,
                            'info'=> $userApp->info,
                            'reference'=> $userApp->reference,
                            'finance'=> $userApp->finance,
                            'loan'=> $userApp->loan,
                         ); */
                $user = User::findOrFail($id);
                $files =  DocFile::where(array('user_id'=>$id))->orderBy('created_at', 'DESC')->get();
                return view('user.application-view', array('user'=>$user, 'files'=>$files));
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
        
    }
    
    public function rentersList()
    {
        if(Auth::user()->user_type=='Tenant' or Auth::user()->status!=1)
        {
            return view('errors.404');
        }
        else
        { 
        
            $query  =  User::where(array('user_type'=>'Tenant', 'status'=>1, 'doc_status'=>'1'));
            if(isset($_GET['town']) and $_GET['town']!=''){
                $query->whereRaw('FIND_IN_SET("'.$_GET['town'].'",towns)');
            }
            $query->orderBy('created_at', 'DESC');
             
            $users = $query->get();
            
            return view('user.tenant-list', array('users'=>$users));
            
        }
    }


    public function createRentalApplication()
    {

        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }

        if(Auth::user()->user_type=='Tenant'){
            $about = TenantAbout::where(array('user_id'=>Auth::id()))->first();
            $residence = TenantResidence::where(array('user_id'=>Auth::id()))->first();
            $occupation = TenantOccupation::where(array('user_id'=>Auth::id()))->first();
            $info = TenantInfo::where(array('user_id'=>Auth::id()))->first();
            $reference = TenantReference::where(array('user_id'=>Auth::id()))->first();
            $finance = TenantFinance::where(array('user_id'=>Auth::id()))->get();
            $loan = TenantLoan::where(array('user_id'=>Auth::id()))->get();
           
            $data = array(
                       'about' => $about,
                       'residence'=>$residence,
                       'occupation'=>$occupation,
                       'info'=>$info,
                       'reference'=>$reference,
                       'finance'=>$finance,
                       'loan'=>$loan,
                    );
           
            return view('rental-application', $data);
        }else{
            return view('apply');
        }
    }
    
    public function updateProfile(Request $request){
        
        $user = User::find(Auth::id());
        
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
        
    }/* updateProfile */



    public function changePassword(){
        if(Auth::user()->user_type=='Tenant' and Auth::user()->doc_status=='0')
        {
            return view('tenant-alert');
        }
        return view('user.password');
    }


   
    public function updatePassword(Request $request){

        $this->validate(request(), [
            'old_password'          => 'required',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        request()->user()->fill([
            'password' => Hash::make(request()->input('password'))
        ])->save();

        return redirect()->back()->withSuccess('Updated Successfully..!!');


    }
    
    public function submitFiles()
    {
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
        $doc->user_id = Auth::id();
        $doc->created_by = 'User';
        $doc->file_name = $filename;
        
        if($doc->save()){
            echo 'success';
        }else{
            echo 'error';
        }
    }

    /*Plan Requests*/
    public function markReadReq(Request $request){
       $req_id = $request->req_id;

       $planRequest = TourRequest::find($req_id);
       $planRequest->is_read = '1';

       if($planRequest->save()){
           echo 'success';
       }else{
           echo 'error';
       }
    }/*markReadReq*/

    public function submitReply(Request $request){

        $reqReply = new ReplyRequest();

        $reqReply->message = $request->message;
        $reqReply->req_id = $request->req_id;
        $reqReply->sender_id = Auth::id();

        $reqReply->save();
        if($reqReply->id){
            echo 'success';
        }else{
            echo 'error';
        }

    }/*submitReply*/

    /**
     * Tenant Portion
     */

    public function submitTenantAbouts(Request $request){
        $percentage = 0;
        if($request->first_name!=''){
            $percentage = $percentage + 10;
        }
        if($request->middle_name!=''){
            $percentage = $percentage + 10;
        }
        if($request->last_name!=''){
            $percentage = $percentage + 10;
        }
        if($request->email!=''){
            $percentage = $percentage + 10;
        }
        if($request->phone!=''){
            $percentage = $percentage + 10;
        }
        if($request->dob!=''){
            $percentage = $percentage + 10;
        }
        if($request->security_no!=''){
            $percentage = $percentage + 20;
        }
        if($request->license_no!=''){
            $percentage = $percentage + 10;
        }
        if($request->license_state!=''){
            $percentage = $percentage + 10;
        }

        $about = TenantAbout::where(array('user_id'=>Auth::id()))->first();
        if(!$about){
            $about = new TenantAbout();
        }

        $about->first_name = $request->first_name;
        $about->middle_name = $request->middle_name;
        $about->last_name = $request->last_name;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->dob = date('Y-m-d', strtotime($request->dob));
        $about->security_no = $request->security_no;
        $about->license_no = $request->license_no;
        $about->license_state = $request->license_state;
        $about->percentage = $percentage;
        $about->user_id = Auth::id();

        if($about->save()){
            echo 'success';
        }else{
            echo 'error';
        }

    }/*submitTenantAbouts*/

    public function submitTenantResidences(Request $request){
        $percentage = 0;
        if($request->curr_housing_type!=''){
            $percentage = $percentage + 20;
        }
        if($request->curr_address!=''){
            $percentage = $percentage + 20;
        }
        if($request->curr_move_date!=''){
            $percentage = $percentage + 20;
        }
        if($request->curr_leaving_reason!=''){
            $percentage = $percentage + 20;
        }
        if($request->prev_housing_type!=''){
            $percentage = $percentage + 20;
        }

        $residence = TenantResidence::where(array('user_id'=>Auth::id()))->first();
        if(!$residence){
            $residence = new TenantResidence();
        }

        $residence->curr_housing_type = $request->curr_housing_type;
        $residence->curr_address = $request->curr_address;
        $residence->curr_move_date = date('Y-m-d', strtotime($request->curr_move_date));
        $residence->curr_rent = $request->curr_rent;
        $residence->curr_landlord_name = $request->curr_landlord_name;
        $residence->curr_landlord_phone = $request->curr_landlord_phone;
        $residence->curr_leaving_reason = $request->curr_leaving_reason;

        $residence->prev_housing_type = $request->prev_housing_type;
        $residence->prev_address = $request->prev_address;
        $residence->prev_move_date = date('Y-m-d', strtotime($request->prev_move_date));
        $residence->prev_rent = $request->prev_rent;
        $residence->prev_landlord_name = $request->prev_landlord_name;
        $residence->prev_landlord_phone = $request->prev_landlord_phone;
        $residence->prev_leaving_reason = $request->prev_leaving_reason;

        $residence->percentage = $percentage;

        $residence->user_id = Auth::id();

        if($residence->save()){
            echo 'success';
        }else{
            echo 'error';
        }

    }/*submitTenantResidences*/

    public function submitTenantOccupation(Request $request){
        $percentage = 0;
        if($request->curr_job_status!=''){
            $percentage = $percentage + 20;
        }
        if($request->curr_job_status=='employed'){
            if($request->curr_job_title!=''){
                $percentage = $percentage + 20;
            }
            if($request->curr_salary!=''){
                $percentage = $percentage + 20;
            }
            if($request->curr_work_type!=''){
                $percentage = $percentage + 10;
            }
            if($request->curr_work_address!=''){
                $percentage = $percentage + 10;
            }

        }
        else{
            if($request->curr_income_source!=''){
                $percentage = $percentage + 30;
            }
            if($request->curr_monthly_income!=''){
                $percentage = $percentage + 30;
            }
        }
        if($request->prev_job_status!=''){
            $percentage = $percentage + 20;
        }

        $occupation = TenantOccupation::where(array('user_id'=>Auth::id()))->first();
        if(!$occupation){
            $occupation = new TenantOccupation();
        }

        $occupation->curr_job_status = $request->curr_job_status;
        $occupation->curr_employer = $request->curr_employer;
        $occupation->curr_job_title = $request->curr_job_title;
        $occupation->curr_salary = $request->curr_salary;
        $occupation->curr_work_type = $request->curr_work_type;
        $occupation->curr_manager = $request->curr_manager;
        $occupation->curr_employer_contact = $request->curr_employer_contact;
        $occupation->curr_work_address = $request->curr_work_address;
        $occupation->curr_join_date = date('Y-m-d', strtotime($request->curr_join_date));
        $occupation->curr_income_source = $request->curr_income_source;
        $occupation->curr_monthly_income = $request->curr_monthly_income;

        $occupation->prev_job_status = $request->prev_job_status;
        $occupation->prev_employer = $request->prev_employer;
        $occupation->prev_job_title = $request->prev_job_title;
        $occupation->prev_salary = $request->prev_salary;
        $occupation->prev_work_type = $request->prev_work_type;
        $occupation->prev_manager = $request->prev_manager;
        $occupation->prev_employer_contact = $request->prev_employer_contact;
        $occupation->prev_work_address = $request->prev_work_address;
        $occupation->prev_join_date = date('Y-m-d', strtotime($request->prev_join_date));
        $occupation->prev_income_source = $request->prev_income_source;
        $occupation->prev_monthly_income = $request->prev_monthly_income;

        $occupation->percentage = $percentage;

        $occupation->user_id = Auth::id();

        if($occupation->save()){
            echo 'success';
        }else{
            echo 'error';
        }

    }/*submitTenantOccupation*/

    public function submitTenantReferences(Request $request){
        $percentage = 0;
        if($request->ref_name!=''){
            $percentage = $percentage + 20;
        }
        if($request->ref_relation!=''){
            $percentage = $percentage + 10;
        }
        if($request->ref_address!=''){
            $percentage = $percentage + 10;
        }
        if($request->ref_phone!=''){
            $percentage = $percentage + 10;
        }
        if($request->emergency_name!=''){
            $percentage = $percentage + 20;
        }
        if($request->emergency_relation!=''){
            $percentage = $percentage + 10;
        }
        if($request->emergency_address!=''){
            $percentage = $percentage + 10;
        }
        if($request->emergency_phone!=''){
            $percentage = $percentage + 10;
        }

        $refrences = TenantReference::where(array('user_id'=>Auth::id()))->first();
        if(!$refrences){
            $refrences = new TenantReference();
        }

        $refrences->ref_name = $request->ref_name;
        $refrences->ref_relation = $request->ref_relation;
        $refrences->ref_address = $request->ref_address;
        $refrences->ref_phone = $request->ref_phone;
        $refrences->emergency_name = $request->emergency_name;
        $refrences->emergency_relation = $request->emergency_relation;
        $refrences->emergency_address = $request->emergency_address;
        $refrences->emergency_phone = $request->emergency_phone;

        $refrences->percentage = $percentage;

        $refrences->user_id = Auth::id();

        if($refrences->save()){
            echo 'success';
        }else{
            echo 'error';
        }


    }

    public function submitAddInfos(Request $request){

        $percentage = 0;
        if($request->add_pets!=''){
            $percentage = $percentage + 20;
        }
        if($request->add_furniture!=''){
            $percentage = $percentage + 10;
        }
        if($request->add_bugs!=''){
            $percentage = $percentage + 20;
        }
        if($request->add_avicted!=''){
            $percentage = $percentage + 10;
        }
        if($request->add_bank!=''){
            $percentage = $percentage + 20;
        }
        if($request->add_smoke!=''){
            $percentage = $percentage + 10;
        }
        if($request->add_drugs!=''){
            $percentage = $percentage + 10;
        }

        $info = TenantInfo::where(array('user_id'=>Auth::id()))->first();
        if(!$info){
            $info = new TenantInfo();
        }

        $info->add_pets = $request->add_pets;
        $info->add_furniture = $request->add_furniture;
        $info->add_bugs = $request->add_bugs;
        $info->add_avicted = $request->add_avicted;
        $info->add_bank = $request->add_bank;
        $info->add_smoke = $request->add_smoke;
        $info->add_drugs = $request->add_drugs;

        $info->percentage = $percentage;

        $info->user_id = Auth::id();

        if($info->save()){
            echo 'success';
        }else{
            echo 'error';
        }

    }/*submitAddInfos*/

    public function submitTenantFinance(Request $request){

        $status = 'success';
        $finance = TenantFinance::where(array('user_id'=>Auth::id()))->get();
        if(count($finance) > 0){
            foreach($finance as $fine){
                $financeObj = TenantFinance::find($fine->id);
                $financeObj->delete();
            }/*foreach*/
        }

        if(count($request->finance_bank_name) > 0){
            for($i=0; $i<count($request->finance_bank_name); $i++){
                $finance = new TenantFinance();
                if($request->finance_bank_name[$i]!=''){

                    $percentage = 0;
                    if($request->finance_bank_name[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->finance_bank_address[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->finance_acc_number[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->finance_acc_balance[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->finance_acc_type[$i]!=''){
                        $percentage = $percentage + 20;
                    }

                    $finance->finance_bank_name  = $request->finance_bank_name[$i];
                    $finance->finance_bank_address  = $request->finance_bank_address[$i];
                    $finance->finance_acc_number  = $request->finance_acc_number[$i];
                    $finance->finance_acc_balance  = $request->finance_acc_balance[$i];
                    $finance->finance_acc_type  = $request->finance_acc_type[$i];
                    $finance->percentage  = $percentage;

                    $finance->user_id = Auth::id();
                    if($finance->save()){
                        $status = 'success';
                    }else{
                        $status = 'error';
                    }
                }
            }/*for*/
        }

        echo $status;

    }/*submitTenantFinance*/

    public function submitTenantLoans(Request $request){

        $status = 'success';
        $loans = TenantLoan::where(array('user_id'=>Auth::id()))->get();
        if(count($loans) > 0){
            foreach($loans as $loan){
                $loanObj = TenantLoan::find($loan->id);
                $loanObj->delete();
            }/*foreach*/
        }

        if(count($request->extras_creditor_name) > 0){
            for($i=0; $i<count($request->extras_creditor_name); $i++){
                $loan = new TenantLoan();
                if($request->extras_creditor_name[$i]!=''){

                    $percentage = 20;
                    if($request->extras_creditor_name[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->extras_creditor_address[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->extras_creditor_phone[$i]!=''){
                        $percentage = $percentage + 20;
                    }
                    if($request->extras_creditor_payment[$i]!=''){
                        $percentage = $percentage + 20;
                    }

                    $loan->extras_creditor_name  = $request->extras_creditor_name[$i];
                    $loan->extras_creditor_address  = $request->extras_creditor_address[$i];
                    $loan->extras_creditor_phone  = $request->extras_creditor_phone[$i];
                    $loan->extras_creditor_payment = $request->extras_creditor_payment[$i];

                    $loan->percentage  = $percentage;

                    $loan->user_id = Auth::id();
                    if($loan->save()){
                        $status = 'success';
                    }else{
                        $status = 'error';
                    }
                }
            }/*for*/
        }

        echo $status;
    }/*submitTenantLoans*/

}
