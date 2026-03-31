<?php

use App\Http\Middleware\CheckAuth;

use App\Http\Middleware\CheckAuthD;
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



Route::group(['middleware' => ['web']], function () {



Route::get('/search','SearchController@indexMeeting');
Route::get('/search/delivers','SearchController@indexDeliver');
Route::get('/search/drops','SearchController@indexDrop');
Route::get('/search/lostItems','SearchController@indexLostItem');

Route::get('autocomplete/{id}',array('as'=>'autocomplete','uses'=>'SearchController@autocomplete'));

 Route::get('denied', array('as' => 'denied', function()
{
    return View::make('errors.401');
}) );


 Route::get('/dashboard/charts', array('as' => 'dashboard.charts', 'uses'=>'DashboardController@getCharts'));

 Route::get('/dashboard/barcharts', array('as' => 'dashboard.barcharts', 'uses'=>'DashboardController@getBarCharts'));
 Route::get('/dashboard/barcharts/show', array('as' => 'barChart.show', 'uses'=>'DashboardController@barChartShow'));

  Route::get('/dashboard/piecharts', array('as' => 'dashboard.piecharts', 'uses'=>'DashboardController@getPieCharts'));

Route::get('/dashboard/tables', array('as' => 'dashboard.tables', 'uses'=>'DashboardController@getTables'));
Route::get('/dashboard/tables/drops', array('as' => 'dashboard.drops', 'uses'=>'DashboardController@getDropsTable'));
Route::get('/dashboard/tables/delivers', array('as' => 'dashboard.delivers', 'uses'=>'DashboardController@getDeliversTable'));
Route::get('/dashboard/tables/lostItems', array('as' => 'dashboard.lostItems', 'uses'=>'DashboardController@getLostItemsTable'));
Route::get('/dashboard/tables/meetings', array('as' => 'dashboard.meetings', 'uses'=>'DashboardController@getMeetingsTable'));




//Extra methods beyond CRUD for Visitor Functionalities

Route::post('/visitors/selfSign', array('as' => 'visitors.selfSign','uses'=>'VisitorController@selfSign' ));

Route::get('/visitors/selfcheckIn',array('as' => 'visitors.selfcheckIn', 'uses' => 'VisitorController@selfcheckIn'));


Route::post('/visitors/checkin/{id}', ['as' => 'visitors.checkin',
                                                        'uses' => 'VisitorController@checkin'
                                                        ]); 
Route::post('/visitors/checkout/{id}', ['as' => 'visitors.checkout',
                                                        'uses' => 'VisitorController@checkout'
                                                        ]);


Route::get('/visitors/internalVisitor/{id}',array('as' => 'visitors.addInternalVisitor', 'uses' => 'VisitorController@addInternalVisitor'))->middleware('CheckAuth');

Route::post('/visitors/storeInternalVisitor', array('as' => 'visitors.storeInternalVisitor', 'uses' => 'VisitorController@storeInternalVisitor'));



Route::delete('/visitors/internalVisitor/{id}/{idM}', ['as' => 'visitors.removeInternalV',
                                                        'uses' => 'VisitorController@removeInternalV'
                                                        ]); 



Route::get('/visitors/createExternalVisitor/{id}',array('as' => 'visitors.createExternalVisitor', 'uses' => 'VisitorController@createExternalVisitor'))->middleware('CheckAuth');

Route::get('/visitors/externalVisitor/{id}', ['as' => 'visitors.badge',
                                                        'uses' => 'VisitorController@badge'
                                                        ]);

Route::post('/visitors/externalVisitor/{id}', ['as' => 'visitors.destroy',
                                                        'uses' => 'VisitorController@destroy'
                                                        ]);








//Extra methods beyond CRUD for Delivery Functionalities




Route::get('/delivers/checkOut/{id}', ['as' => 'delivers.checkout',
                                                        'uses' => 'DeliverController@showCheckOut'
                                                        ]);

Route::post('/delivers/checkOut/update/{id}', ['as' => 'delivers.checkoutUpdate',
                                                        'uses' => 'DeliverController@checkoutUpdate'
                                                        ]);




Route::resource('delivers','DeliverController');


//Routes to extra methods beyond CRUD for Delivery Type Functionalities




Route::get('/deliveryType/create/{id}', ['as' => 'deliveryType.createDeliveryType',
                                                        'uses' => 'DelivertypeController@createDeliveryType'
                                                        ]);
Route::resource('deliveryType','DelivertypeController');


//Extra methods beyond CRUD for Drop Functionalities

Route::get('/drops/{idDrop}/checkOut/', ['as' => 'drops.checkOut',
                                                        'uses' => 'DropController@checkout'
                                                        ]); 

Route::put('/drops/{idDrop}', ['as' => 'drops.updateEdit',
                                                        'uses' => 'DropController@updateEdit'
                                                        ]);

Route::put('/drops/Checkout/Update/{idDrop}', ['as' => 'drops.updateCheckOut',
                                                        'uses' => 'DropController@updateCheckOut'
                                                        ]);


Route::get('/drops/{idDrop}/show/', ['as' => 'drops.show',
                                                        'uses' => 'DropController@show'
                                                        ]); 
Route::resource('drops','DropController');


//Routes to extra methods beyond CRUD for Lost and Found Functionalities

Route::get('/losts/{id}/checkOut/', ['as' => 'losts.checkout',
                                                        'uses' => 'LostFoundController@checkout'
                                                        ]); 
Route::post('/losts/checkOut/{id}', ['as' => 'losts.updateCheckOut',
                                                        'uses' => 'LostFoundController@updateCheckOut'
                                                        ]); 



//Resources From The Controllers
Route::resource('visitors','VisitorController');

Route::resource('losts', 'LostFoundController');

Route::resource('meetings','MeetingController');



//Middleware CheckAuthD is to allow only the staff to perfom meetings and visitors functionalities

Route::group(['middleware' => 'CheckAuth'], function()
{
    Route::resource('meetings', 'MeetingController', ['only' => ['create','store']]);

    Route::resource('visitors','VisitorController', ['only' => ['createExternalVisitor', 'addInternalVisitor','storeInternalVisitor','store','destroy','removeInternalV']]);
     
});


//Middleware to restrict users functionalities
//Middleware CheckAuthD is to allow only the security guard to perfom delivery, drop and lostfound functionalities

Route::group(['middleware' => 'CheckAuthD'], function()
{
    Route::resource('delivers', 'DeliverController');
    Route::resource('losts', 'LostFoundController');
    Route::resource('drops','DropController');
    Route::resource('deliveryType','DelivertypeController');


});



//Initial Pages
Route::get('dashboard', [ 'as'=>'dashboard','uses'=>'DashboardController@getDashboard']);
Route::get('contact', 'PagesController@getContact');
Route::get('about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');



//Authentication Routes
Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration
Route::get('register',  'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset
Route::get('auth/password/reset',         'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('auth/password/email',        'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('auth/password/reset',        'Auth\ResetPasswordController@reset')->name('password.reset.submit');

// Onboarding (auth required, no org.active check yet — org is being set up)
Route::get('onboarding/plan',    'OnboardingController@showPlanSelection')->name('onboarding.plan')->middleware('auth');
Route::post('onboarding/plan',   'OnboardingController@selectPlan')->middleware('auth');
Route::get('onboarding/billing', 'OnboardingController@showBillingSetup')->name('onboarding.billing')->middleware('auth');
Route::post('onboarding/billing','OnboardingController@processBilling')->middleware('auth');
Route::get('onboarding/complete','OnboardingController@complete')->name('onboarding.complete')->middleware('auth');

// Stripe Webhook (must be outside CSRF middleware — see VerifyCsrfToken)
Route::post('stripe/webhook', 'WebhookController@handle');

// Tenant Admin Panel
Route::group(['middleware' => ['auth', 'org.active', 'org.admin'], 'prefix' => 'admin'], function () {
    Route::get('/',                'TenantAdminController@index')->name('admin.index');
    Route::get('/users',           'TenantAdminController@users')->name('admin.users');
    Route::post('/users',          'TenantAdminController@storeUser')->name('admin.users.store');
    Route::get('/users/{id}/edit', 'TenantAdminController@editUser')->name('admin.users.edit');
    Route::put('/users/{id}',      'TenantAdminController@updateUser')->name('admin.users.update');
    Route::delete('/users/{id}',   'TenantAdminController@destroyUser')->name('admin.users.destroy');
    Route::get('/settings',        'TenantAdminController@settings')->name('admin.settings');
    Route::put('/settings',        'TenantAdminController@updateSettings')->name('admin.settings.update');
    Route::get('/billing',         'BillingController@show')->name('billing.show');
    Route::post('/billing/subscribe',  'BillingController@subscribe')->name('billing.subscribe');
    Route::post('/billing/plan',       'BillingController@updatePlan')->name('billing.update-plan');
    Route::post('/billing/payment',    'BillingController@updatePaymentMethod')->name('billing.payment');
    Route::post('/billing/cancel',     'BillingController@cancel')->name('billing.cancel');
});


});






