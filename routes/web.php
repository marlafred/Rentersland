<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index')->name('home');


Route::get('maps', 'HomeController@maps')->name('maps');

Route::get('dropzone', 'DropzoneController@index');
Route::post('dropzone/uploadFiles', 'DropzoneController@uploadFiles')->name('dropzone.uploads');

Route::get('/tenant-register', 'HomeController@tenantRegister')->name('tenant.register');
Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact-us', 'HomeController@contactUs')->name('contact.us');
Route::get('/terms', 'HomeController@termsAndConditions')->name('terms');
Route::get('/how-it-works', 'HomeController@howItWorks')->name('how.it.works');
Route::post('/submit-contactform', 'HomeController@submitContactForm')->name('submit.contact');
Route::post('/submit-newsletetr', 'HomeController@submitNewsletterForm')->name('submit.newsletter.form');


Route::post('/success', 'HomeController@tenantRegisterStore')->name('registersuccess');

Route::get('/listings/{state?}', 'ListingController@getListings')->name('listings');
Route::get('/listing/detail/{slug?}', 'ListingController@listingDetail')->name('detail.listing');

Route::post('/submit-plan', 'HomeController@submitPlan')->name('submit.plan');
Route::post('/submit-plan', 'HomeController@submitPlan')->name('submit.plan');

/*Rentals*/
Route::get('/apply', 'HomeController@apply')->name('apply');
Route::get('/rentals', 'HomeController@rentals')->name('rentals');
Route::get('/rentals-application', 'UserController@createRentalApplication')->name('create.rental.application');
Route::post('/apply-listing', 'ListingController@applyLinting')->name('apply.listing');


/*Search*/
Route::any('/search-results', 'SearchController@homeSearch')->name('home.search.submit');
Route::post('/ajax-search', 'SearchController@ajaxSearch')->name('ajax.search.submit');
Route::post('/search-listings', 'SearchController@commonSearch')->name('common.search.submit');

Auth::routes();
Route::prefix('user')->group(function(){
    Route::get('/renters-login', 'Auth\UserLoginController@rentersLoginForm')->name('renters.login');
    Route::get('/landlord-login', 'Auth\UserLoginController@landlordLoginForm')->name('landlord.login');
    Route::post('/login', 'Auth\UserLoginController@login')->name('user.login.submit');
    
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('user.logout');
    
    Route::get('/tenant-alert', 'UserController@tenantAlert')->name('tenant.alert');
    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::post('/update-profile', 'UserController@updateProfile')->name('user.update.profile');
    
    Route::get('/change-password', 'UserController@changePassword')->name('user.change.password');
    Route::post('/update-password', 'UserController@updatePassword')->name('user.update.password');
    
    Route::get('/applied-listings', 'UserController@listingsApplied')->name('user.listings.applied');
    Route::get('/tenant-applications', 'UserController@tenantApplications')->name('user.tenant.listings');

    Route::get('/dashboard', 'UserController@dashboard')->name('user.dashboard');
    Route::get('/listings', 'UserController@listings')->name('user.listings');
    Route::get('/plan-requests', 'UserController@planRequests')->name('user.tour.requests');
    Route::get('/favourites', 'UserController@dashboard')->name('user.favourites');
    Route::get('/conatcts', 'UserController@dashboard')->name('user.conatcts');
    
    Route::get('/renters-list', 'UserController@rentersList')->name('renters.list');
    
    /*Plan Requests*/
    Route::post('/mark-read', 'UserController@markReadReq')->name('mark.read');
    Route::post('/submit-reply', 'UserController@submitReply')->name('submit.reply');
    
    /*Rental Application*/
    Route::post('/submit-tenantabouts', 'UserController@submitTenantAbouts')->name('submit.tenantabouts');
    Route::post('/submit-tenantresidences', 'UserController@submitTenantResidences')->name('submit.tenantresidences');
    Route::post('/submit-tenantoccupation', 'UserController@submitTenantOccupation')->name('submit.tenantoccupation');
    Route::post('/submit-tenantinfos', 'UserController@submitAddInfos')->name('submit.tenantinfos');
    Route::post('/submit-tenantreferences', 'UserController@submitTenantReferences')->name('submit.tenantreferences');
    Route::post('/submit-tenantfinances', 'UserController@submitTenantFinance')->name('submit.tenantfinances');
    Route::post('/submit-tenantloans', 'UserController@submitTenantLoans')->name('submit.tenantloans');
    
    Route::get('/view-profile/{slug?}', 'UserController@viewApplication')->name('view.tenant.app');
    
    Route::get('/view-files', 'UserController@viewFiles')->name('tenant.submitted.files');
    
    Route::post('/tenant-submit-files', 'UserController@submitFiles')->name('tenant.submit.files');
    
    Route::post('/delete-listing', 'ListingController@deleteListing')->name('user.delete.listing');
    
    
});

Route::get('/create-listings/{slug?}', 'ListingController@createListing')->name('ceate.listing');
Route::post('/listing/submit', 'ListingController@submitListing')->name('submit.listings');

Route::prefix('admin')->group(function(){

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
    
    Route::get('/slider', 'AdminController@slider')->name('admin.slider');
    Route::get('/how-it-works', 'AdminController@howitWorks')->name('admin.works');
    Route::get('/how-it-works-boxes/{slug?}', 'AdminController@howitWorksBoxes')->name('admin.works-boxes');
    Route::get('/about-us', 'AdminController@aboutUs')->name('admin.aboutus');
    
    Route::get('/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/states', 'AdminController@states')->name('admin.states');
    Route::get('/navigation', 'AdminController@navigation')->name('admin.navigation'); 
    Route::get('/footer/{slug?}', 'AdminController@footerNavigation')->name('admin.footer.navigation'); 
    
    Route::get('/newsletters', 'AdminController@newsletters')->name('admin.newsletters');
    Route::get('/newsletters/create/{slug?}', 'AdminController@createNewsletter')->name('admin.create.newsletter');
    Route::post('/submit-newsletter', 'AdminController@submitNewsletter')->name('admin.submit.newsletter');
    Route::get('/send-newsletter', 'AdminController@sendNewsletter')->name('admin.send.newsletter');
    Route::post('/send-user-newsletter', 'AdminController@sendUserNewsletter')->name('send.newsletter');
    
    Route::get('/newsletters/subscribers', 'AdminController@subscribers')->name('admin.subscribers');
    Route::get('/newsletters/log', 'AdminController@log')->name('admin.log');
    
    Route::get('/pages', 'AdminController@pages')->name('admin.pages');
    Route::get('/add-pages/{slug?}', 'AdminController@addPages')->name('admin.add.pages');
    
    
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::get('/requests', 'AdminController@planRequests')->name('admin.requests');
    
    
    Route::get('/listings', 'AdminController@listings')->name('admin.listings');
    Route::get('/mylistings', 'AdminController@adminListings')->name('admin.my.listings');
    Route::get('/createlistings/{slug?}', 'AdminController@createListings')->name('admin.create.listings');
    Route::get('/listing/detail/{slug?}', 'AdminController@listingDetail')->name('admin.detail.listing');
    
    
    Route::get('/applicants', 'AdminController@applicants')->name('admin.applicants');
    
    Route::get('/submit-states', 'AdminController@submitStats')->name('admin.submit.states');
    
    Route::get('/accounts', 'AdminController@users')->name('admin.users');
    
    Route::get('/tenants', 'AdminController@tenants')->name('admin.tenants');
    
    Route::get('/tenant-application', 'AdminController@tenantApplications')->name('admin.tenant.apps');
    
    Route::get('/view-application/{user?}', 'AdminController@viewApplication')->name('admin.view.application');
    
    Route::get('/edit-application/{user?}', 'AdminController@editApplication')->name('admin.edit.application');
    
    Route::get('/tenant-files/{slug?}', 'AdminController@tenatFiles')->name('tenant.files');
    
    Route::get('/bubbles', 'AdminController@bubbles')->name('bubbles');
    
    Route::get('user/edit/{id}', 'AdminController@editUser')->name('edit.user');
    Route::post('user/update/{id}', 'AdminController@updateUser')->name('update.user');
    
    /*
     * Emails Templates
     */
    Route::get('/email/register', 'AdminController@emailRegister')->name('admin.email.register');
    Route::get('/email/listing', 'AdminController@emailListing')->name('admin.new.listing');
    Route::get('/email/register-notify', 'AdminController@emailRegisterNotify')->name('admin.email.register.notify');
    Route::get('/email/listing-notify', 'AdminController@emailListingNotify')->name('admin.new.listing.notify');
    Route::get('/email/renter-activate', 'AdminController@emailRenterActivate')->name('admin.email.renters.acc-active');
    Route::get('/email/landlord-activate', 'AdminController@emailLandlordActivate')->name('admin.email.landlord.acc-active');
    
});


Route::post('/submit-listing', 'AdminController@submitListing')->name('admin.submit.listings');

Route::post('/submit-sliders', 'AdminController@submitSlider')->name('submit.sliders');
Route::post('/submit-aboutus', 'AdminController@submitAboutus')->name('submit.aboutus');
Route::post('/submit-settings', 'AdminController@submitSettings')->name('submit.settings');
Route::post('/submit-menu', 'NavigationController@updateMenu')->name('submit.menu');
Route::post('/update-positions', 'NavigationController@updatePositions')->name('update.positions');
Route::post('/submit-howitworks', 'AdminController@submitHowitWorks')->name('submit.howitworks');
Route::post('/submit-bubbles', 'AdminController@submitBubbles')->name('submit.bubbles');
Route::post('/submit-page', 'AdminController@submitPages')->name('submit.pages');

/*Emails*/
Route::post('/update-email', 'AdminController@updateEmail')->name('update.email');


/*Delete*/
Route::post('/delete-state', 'DeleteController@deleteState')->name('delete.state');
Route::post('/delete-page', 'DeleteController@deletePage')->name('delete.page');
Route::post('/delete-listing', 'DeleteController@deleteListing')->name('delete.listing');
Route::post('/delete-multiple-listings', 'DeleteController@deleteMultipleListing')->name('delete.multiple.listings');
Route::post('/update-multiple-listings', 'UpdateController@updateListingsStatus')->name('update.multiple.listings');

Route::post('/delete-files', 'DeleteController@deleteFiles')->name('delete.files');

Route::post('/delete-user', 'DeleteController@deleteUser')->name('delete.user');
Route::post('/delete-multiple-users', 'DeleteController@deleteMultipleUser')->name('delete.multiple.users');
Route::post('/update-multiple-users', 'UpdateController@updateUserStatus')->name('update.multiple.users');

Route::post('/tenant-files/{slug?}', 'AdminController@SubmitTenatFiles')->name('submit.tenant.files');

//Catch all page controller (place at the very bottom)
Route::get('{slug}', [
    'uses' => 'PageController@getPage' 
])->where('slug', '([A-Za-z0-9\-\/]+)');
