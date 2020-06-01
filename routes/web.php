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

/*Route::get('/', function () {
	return view('welcome');
});*/
Route::get('/','home@index');

Route::get('role',[
   'middleware' => 'Role:editor',
   'uses' => 'TestController@index',
]);

Route::get('register','UserRegistration@register');
Route::post('/user/register','UserRegistration@signup');
Route::get('login','UserRegistration@login');
Route::get('logout', 'UserRegistration@logout');
Route::post('/user/signin','UserRegistration@signin');
Route::get('view-records','UserRegistration@view');
Route::get('edit/{id}','UserRegistration@view_edit');
Route::post('edit/{id}','UserRegistration@edit');
Route::get('delete/{id}','UserRegistration@destroy');
Route::get('layout','UserRegistration@layout');

Route::get('home','home@index');
Route::get('about-us','home@about');
Route::get('contact-us','home@contact');
Route::get('products/{id}','home@products');
Route::get('all-products','home@all_products');
Route::get('wishlist','home@wishlist');
Route::get('view-product','home@view_product');
Route::get('product-details/{id}','home@product_details');
Route::get('cart','home@cart');
Route::get('checkout','home@checkout');
Route::post('add-to-cart','home@add_to_cart');
Route::post('my-account', 'home@my_account');
Route::post('remove-to-cart','home@remove_to_cart');
Route::get('send-notificaiton','home@send_notificaiton');

Route::get('get-flight-data','FlightController@index');
Route::get('get-flight-data-specific/{id}','FlightController@specific_record');
Route::get('get-flight-data-where/{id}','FlightController@where_record');
Route::get('get-flight-data-update/{id}','FlightController@update_record');
Route::get('thank-you','FlightController@thank_you');
Route::get('get-all-category','FlightController@get_all_category');
Route::get('normal-join','FlightController@normal_join');
Route::get('get-join-data','FlightController@get_join_data');
