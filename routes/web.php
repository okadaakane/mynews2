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


//【応用】 前章でAdmin/ProfileControllerを作成し、
//add Action, edit Actionを追加しました。web.phpを編集して、
//admin/profile/create にアクセスしたら ProfileController の add Action に、
//admin/profile/edit にアクセスしたら ProfileController の edit Action に
//割り当てるように設定してください。



Route::group(['prefix' =>'admin', 'middleware' => 'auth'],function(){
	Route::get('profile/create', 'Admin\ProfileController@add');
	Route::post('profile/create', 'Admin\ProfileController@create');
	Route::get('profile/edit', 'Admin\ProfileController@edit');
	Route::get('profile', 'Admin\ProfileController@index');
	Route::post('profile/edit', 'Admin\ProfileController@update');
    Route::get('profile/delete', 'Admin\ProfileController@delete');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
    Route::get('news', 'Admin\NewsController@index')->middleware('auth'); 
    Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth'); // 追記
    Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth');
    Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');
// /profile にアクセスが来たら ProfileController/index Action に渡すように設定してください。
Route::get('/profile', 'ProfileController@index');