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


Route::prefix('login')->group(function (){
    //Admin
    Route::get('/admin', 'AdminAuth\LoginController@showLoginForm')->name('admin.loginForm');
    Route::post('/admin', 'AdminAuth\LoginController@login')->name('admin.login');

});

Route::middleware('admin.auth')->prefix('admin')->namespace('Admin')->group(function (){

    Route::get('/', 'DashboardController@dashboard')->name('admin.index');


    Route::resource('/sliders', 'SliderController');

    Route::resource('/brands', 'BrandsController');

    Route::resource('/categories', 'CategoryController');
    Route::get('/categories/{id}/categories', 'CategoryController@categories')->name('categories.categories');


    /*
     * Product route
     */
    Route::resource('/products', 'ProductController');
    Route::get('/removeGalleryImage/{image_id}/{product_id}', 'ProductController@removeGalleryImage')->name('custom.ImageDelete');

    Route::resource('/users', 'UserController');
    Route::put('/users/{id}/changePassword', 'UserController@passwordChange')->name('users.change.password');
    // Profilena
    Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');

    Route::get('/dashboard/to/another/color', 'DashboardController@dashboardColorChange')->name('admin.dashboard.color.change');
    /**
     * Контакты
     */
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact/edit', 'ContactController@edit')->name('contact.edit');

    // Registration requests
    Route::resource('/requests', 'RequestController');
    Route::get('/requests/{id}/confirm', 'RequestController@confirmRequest')->name('requests.confirm');

    // Orders
    Route::resource('/orders', 'OrderController');
    Route::get('/orders/{id}/status', 'OrderController@changeStatus')->name('orders.status');

    // Feedbacks
    Route::resource('/feedbacks', 'FeedbackController');
});


// Cart routes
Route::namespace('Front')->group(function() {
    Route::post('/cart/add', 'CartController@addToCart')->name('cart.add');
    Route::post('/cart/update', 'CartController@update')->name('cart.update');
    Route::post('/cart/remove', 'CartController@removeFromCart')->name('cart.remove');
});

// FrontAuthentication Routes...
Route::get('logout', 'FrontAuth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::get('password/reset', 'FrontAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'FrontAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'FrontAuth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'FrontAuth\ResetPasswordController@reset');

Route::post('/feedback', 'HomeController@createFeedback')->name('feedback.create');

Route::get('/admin/setWebhook', function(Request $request) {
    dd(request()->getHttpHost().'/'.\Telegram::getAccessToken().'/webhook');
    $response = \Telegram::setWebhook(['url' => request()->getHttpHost().'/'.\Telegram::getAccessToken().'/webhook']);
    return $response->getBody();
});

Route::post('/'.\Telegram::getAccessToken().'/webhook', function () {
    \Telegram::commandsHandler(true);

    return 'ok';
});


Route::middleware('catalog')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/login', 'FrontAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'FrontAuth\LoginController@login');
    Route::get('/register', 'FrontAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'FrontAuth\RegisterController@register');
    Route::get('/cart', 'Front\CartController@index')->name('cart.index');
    Route::post('/cart', 'Front\CartController@createOrder')->name('cart.order');
    Route::get('/request', 'Front\RequestController@index');
    Route::post('/request', 'Front\RequestController@storeRequest');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/{params}', 'Front\CatalogController@index')->where('params', '.+')->name('catalog.index');

});
