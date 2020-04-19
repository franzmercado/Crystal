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
// Route::get('/', function () {
//     return view('welcome')->with('special_js', 'sample');
// });
Route::get('/', 'HomeController@index')->name('home');
Route::get('/showAll', 'HomeController@showAll')->name('showAll');
Route::get('/category={cid}/show={id}', 'HomeController@showProduct')->name('showProduct');
Route::get('/category={cid}', 'HomeController@showCategory')->name('FilterCategory');
Route::get('/scripts/{script}.js', 'ScriptController@script')->name('script');
Route::get('/search', 'HomeController@searchProduct')->name('searchProduct');


Auth::routes([ 'verify' => true ]);

Route::get('/profile', 'UsersController@index')->name('profile');
Route::put('/profile/saveInfo', 'UsersController@saveInfo')->name('saveInfo');
Route::put('/profile/saveAddress', 'UsersController@saveAddress')->name('saveAddress');
Route::patch('/profile/checkPass', 'UsersController@checkPass')->name('checkPass');
Route::patch('/profile/changePass', 'UsersController@changePass')->name('changePass');
Route::get('/orders', 'UsersController@orders')->name('orders');
Route::patch('/orders/cancel/{id}', 'UsersController@cancelOrder')->name('cnlOrder');
Route::get('/carts', 'UsersController@carts')->name('carts');
Route::get('/countCart', 'UsersController@countCart')->name('countCart');
Route::get('/getcarts', 'UsersController@getCarts')->name('getCarts');
Route::post('/carts/add', 'UsersController@addToCart')->name('addToCart');
Route::post('/carts/del/{id}', 'UsersController@removeToCart')->name('removeToCart');
Route::any('/carts/checkout', 'UsersController@checkOut')->name('checkOut');
Route::get('/carts/checkStocks', 'UsersController@checkStocks')->name('checkStocks');
Route::post('/carts/order', 'UsersController@placeOrder')->name('placeOrder');
Route::post('/carts/changeqty', 'UsersController@changeQty')->name('changeQty');








Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){

    /**
     * Admin Auth Route(s)
     */
    Route::namespace('Auth')->group(function(){

        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');

        //Register Routes
        // Route::get('/register','RegisterController@showRegistrationForm')->name('register');
        // Route::post('/register','RegisterController@register');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

        // Email Verification Route(s)
        Route::get('email/verify','VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}','VerificationController@verify')->name('verification.verify');
        Route::get('email/resend','VerificationController@resend')->name('verification.resend');

    });

    Route::get('/','HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/getSales', 'HomeController@getSales')->name('getSales');

    Route::get('/scripts/{script}.js', 'ScriptController@script')->name('script');

    Route::resource('categories', 'CategoriesController');

    Route::get('/users','UsersController@index')->name('users');
    Route::get('/users/{id}','UsersController@show')->name('showUser');
    Route::patch('/users/act/{id}','UsersController@activate')->name('actUser');
    Route::patch('/users/deact/{id}','UsersController@deactivate')->name('deactUser');
    Route::get('/products', 'ProductsController@index')->name('manageProducts');
    Route::get('/products/add', 'ProductsController@addProduct')->name('addProduct');
    Route::post('/products/store', 'ProductsController@store')->name('storeProduct');
    Route::put('/products/restock/{id}', 'ProductsController@restockProduct')->name('restockProd');
    Route::put('/products/update/{id}', 'ProductsController@updateProduct')->name('updateProduct');
    Route::delete('/products/del/{id}', 'ProductsController@destroy')->name('delProduct');
    Route::get('/products/restock', 'ProductsController@restock')->name('restockProduct');
    Route::get('/transactions', 'TransactionController@index')->name('transactions');
    Route::get('/transactions/{id}', 'TransactionController@showOrders')->name('showOrders');
    Route::patch('/transactions/cancel/{id}', 'TransactionController@cancelOrder')->name('cancelOrder');
    Route::patch('/transactions/accept/{id}', 'TransactionController@acceptOrder')->name('acceptOrder');
    Route::patch('/transactions/ship/{id}', 'TransactionController@shipOrder')->name('shipOrder');
    Route::patch('/transactions/deliver/{id}', 'TransactionController@deliverOrder')->name('deliverOrder');
    Route::get('/reports', 'ReportController@index')->name('reports');




    Route::get('/products/{id}', 'ProductsController@selProduct')->name('selProduct');









});
