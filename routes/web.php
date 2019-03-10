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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post','PostController@index')->middleware('auth');
Route::get('/addPost','PostController@create');
Route::post('/addPost','PostController@store');
Route::get('/view/{id}','PostController@show');
Route::get('/edit/{id}','PostController@edit');
Route::post('/updatePost/{id}','PostController@update');
Route::get('/deletePost/{id}','PostController@destroy');
Route::get('/category/{id}','PostController@category');
Route::get('/like/{id}','PostController@like');
Route::get('/dislike/{id}','PostController@dislike');
Route::post('/comment/{id}','PostController@comment');
Route::post('/search','PostController@search');

Route::get('/category','CategoryController@index')->middleware('auth');
Route::get('/addCategory','CategoryController@create')->middleware('auth');
Route::post('/addCategory','CategoryController@store');
Route::get('/profile','ProfileController@index')->middleware('auth');
Route::get('/addProfile','ProfileController@create');
Route::post('/addProfile','ProfileController@store');
