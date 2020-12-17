<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'blogController@index')->name('index');

Route::get('category/{slug}', 'blogController@category')->name('category');

Route::get('post/{slug}', 'blogController@post')->name('post');

Route::get('page/{slug}', 'blogController@page')->name('page');

Route::get('contact', 'blogController@displayContactForm')->name('contact.show');

Route::get('contact', 'blogController@submitContactForm')->name('contact.submit');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

			Route::resource('categories', 'categoryController');
			Route::resource('posts', 'postController'); Route::resource('pages',
			'pageController'); Route::resource('galleries', 'galleryController');

});
