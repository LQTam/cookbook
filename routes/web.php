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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about','PagesController@about')->name('about');
Route::get('/contact','PagesController@contact')->name('contact');

Route::prefix('login')->group(function(){
    Route::get('facebook','AuthController@redirectToFacebook')->name('login.facebook');
    Route::get('facebook/callback','AuthController@getFacebookCallback')->name('login.facebook.callback');
});