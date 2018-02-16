<?php

Route::get('/','IndexController@index');

Route::get('/hehe', function (){

   return  App\Activity::all();
});


/** login functionality **/
Route::resource('login', 'LoginController');
Route::post('login/user','LoginController@loginUser');
Route::get('logout/user', 'LogoutController@userlogout');
Route::get('/emailVerification/account=Active&user_id={id}', 'LoginController@activate');

/** register functionality **/
Route::resource('register', 'RegisterController');

/** analytics functionality **/
Route::resource('analytics', 'AnalyticsController')->middleware('checkauth');
Route::post('analytics/sales-data', 'AnalyticsController@sales');
Route::post('get-store-demand', 'AnalyticsController@storeDemand');
Route::post('get-store-supply', 'AnalyticsController@storeSupply');
Route::post('get-supply-demand', 'AnalyticsController@demand');
Route::post('get-demand-supply', 'AnalyticsController@supply');
Route::post('pie/category-bought', 'AnalyticsController@categoryBought');

/** product functionality **/
Route::resource('product', 'ProductController');
Route::get('/sell-product', 'ProductController@view');
Route::get('/p/id={id}&name={slug}', 'ProductController@inMarket')->middleware('checkslug');
Route::post('buy/send-notif', 'ProductController@buyer');
Route::post('edit/{id}', 'ProductController@editFunction');
Route::get('cities', function (){

    return (new \App\Repositories\Cities)->all();
});

/** category functionality **/
Route::resource('category', 'CategoryController');
Route::get('count-category', 'CategoryController@count');
Route::get('category/{category}/search', 'CategoryController@filter')->name('filterCategory');
Route::post('fulltext', 'CategoryController@fullTextSearch');

/** dashboard **/
Route::get('store', 'StoreController@show')->middleware('checkauth');
Route::get('orders','StoreController@Order')->middleware('checkauth');;
Route::get('/page/store', 'StoreCotroller@pagination');
Route::post('/search-by-category' ,'StoreController@searchCategory');
Route::post('/search-by-name' ,'StoreController@searchName');
Route::post('store-modal-edit', 'StoreController@modalEdit');
Route::post('product-make-bargain','StoreController@bargain');
Route::post('change-position', 'StoreController@changePos');
Route::post('clone-product', 'StoreController@cloneProduct');
Route::post('create-group', 'StoreController@createGroup');

/** user **/
Route::resource('haggler', 'HagglerController');
Route::post('haggler/search', 'HagglerController@search');
Route::post('haggler/featured','HagglerController@featured');
Route::resource('haggler.user', 'HaggleUserController');
Route::post('user-product-category-filter', 'HaggleUserController@filterCategory');
Route::post('user-product-date-filter', 'HaggleUserController@filterDate');
Route::post('user-product-price-filter' , 'HaggleUserController@filterPrice');

/** global searching **/
Route::get('/product/search/{tag}', 'SearchController@show');
Route::get('fetch/category/name', 'CategoryController@name');
Route::post('filter-by-price', 'SearchController@filterPrice');
Route::post('filter-by-date', 'SearchController@filterDate');
Route::post('filter-by-category', 'SearchController@filterCategory');

/** bargain **/
Route::resource('bargain', 'BargainController');
Route::get('bargain-list','BargainController@list');
Route::post('list-search','BargainController@searchList');
Route::post('bargain/modal-deal', 'BargainController@modalDeal');
Route::post('bargain/accept-order', 'BargainController@acceptDeal');

/** Notification **/
Route::resource('notification', 'NotificationController');

/** Billing **/
Route::resource('billing', 'BillingController');
Route::post('billing/order/deal','BillingController@deal');
Route::get('billing/order/summary/order-number={id}','BillingController@summary');
Route::get('billing/seller/{id}','BillingController@seller');
Route::post('billing/seller/save','BillingController@sellerSave');

/** Delivery Information **/
Route::get('deliveryinformation/trackingnumber={code}', 'trackingController@show');
Route::post('/continue-shopping','trackingController@sendEmail');

/** Manage account **/

Route::get('manage-account', 'ManageController@index');
Route::post('/changeDp', ['as'=>'changeDp','uses'=>'ManageController@updateDp']);

/** Chat room **/
Route::get('/messages', 'MessageController@index')->middleware('checkauth');;
Route::get('/messages/{id}','MessageController@show');
Route::post('/modal-send-message', 'MessageController@modalMsg');
Route::get('fetch-messages', 'MessageController@fetchMessages');
Route::post('send-messages', 'MessageController@sendMessage');

Route::get('/sample', function (){

    $data = array('email' => 'penpen0928@gmail.com' , 'id' => '1');

    return view('emails.thanks', compact('data'));
});

Route::post('/sample', 'BargainController@sample1');

Route::get('/tae', function(){
    
    return App\MessageRoom::where(['user_one' => Auth::id(), 'user_two' => 16])

    ->orWhere(['user_one' => 16, 'user_two' => Auth::id()])->first();
});