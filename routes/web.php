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
Route::get('/', 'PagesController@index');
Route::get('/admin/home', 'ProductsController@adminProduct');
Route::get('/admin/category', 'CategoriesController@adminCategory');
Route::get('/cart/test', 'OrdersController@test');
Route::resource('cate','CategoriesController');
Route::resource('prod','ProductsController');
Route::resource('favo','FavoritesController');
Route::resource('order','OrdersController');
Route::resource('cart','CartsController');
Route::post('/search','PagesController@search');
Route::post('/searcha','PagesController@advanceSearch');
Route::post('/cart/items_num','CartsController@items_num');
Route::post('/favo/check','FavoritesController@check');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
