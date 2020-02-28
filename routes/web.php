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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) { error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); }


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('posts', 'PostsController');
});

Route::get('notify/{msg?}', 'UsersController@sendNotification');
Route::get('test/{msg?}', function () {
  $current_msg = request()->route()->parameter('msg');
    event(new App\Events\StatusLiked('Guest',$current_msg));
    return "Event has been sent!";
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
	Route::get('/notifications', 'UsersController@notifications');  
});



//Route::get('/m', 'ChatsController@index');
//Route::get('messages', 'ChatsController@fetchMessages');
//Route::post('messages', 'ChatsController@sendMessage'); 
