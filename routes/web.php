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
Route::get('cart','home@cart');
Route::get('checkout','home@checkout');
Route::post('add-to-cart','home@add_to_cart');

Route::get('get-flight-data','FlightController@index');
