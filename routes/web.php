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

Route::get('/', function () {
    return view('welcome');

});
Route::delete('/carts/empty','CartController@empty')->name('carts.empty');
Route::post("/transactions/paypal",'TransactionController@create_paypal_payment')->name("transactions.paypal");

Route::resource('categories', 'CategoryController');
Route::resource('products','ProductController');
Route::resource('carts','CartController');
Route::resource('transactions','TransactionController');

// Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
// Route::get('/categories','CategoryController@index')->name('categories.index');
// Route::get('/categories/{category}','CategoryController@show')->name('categories.show');
// Route::get('/categories/{category}/edit','CategoryController@edit')->name('categories.edit');
// Route::post('/categories','CategoryController@store')->name('categories.store');
// Route::put('/categories/{category}','CategoryController@update')->name('categories.update');
// Route::delete('/categories/{category}','CategoryController@destroy')->name('categories.destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
