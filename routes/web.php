<?php

use App\Events\MyEvent;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'products', 'middleware' => ['auth']], function () {

    Route::get('products/{id}', 'ProductController@show')->name('products.show');
    Route::get('products/create', 'ProductController@create')->name('products.create');
    Route::get('products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::post('/products', 'ProductController@store')->name('products.store');
    Route::patch('products/{id}', 'ProductController@update')->name('products.update');
    Route::delete('products/{id}', 'ProductController@destroy')->name('products.destroy');
//
});

Route::get('users', 'UserController@index')->name('users.index');
//
//
Route::get('ajax', 'AjaxController@view');
Route::post('ajax', 'AjaxController@send_http_request')->name('ajaxRequest.post');
//
////Push notification with pusher
Route::get('test', function () {
    event(new MyEvent('آیا میخواهید نوتیفی برایتان بیاید؟'));
    return "Event has been sent!";
});

//Push notification with NotificationController
Route::get('notify', 'NotificationController@notify');
Route::view('/notification', 'notification');


//Real Time Event Broadcasting with Laravel 6 and Pusher
Route::get('/post', 'PostController@index')->name('post')->middleware('auth');
Route::post('/post', 'PostController@createPost')->middleware('auth');

//live search with ajax

Route::get('live_search', 'LiveSearch@index');
Route::get('live_search/action', 'LiveSearch@action')->name('live_search.action');

//modal bootstrap edited by me in local repository
Route::get('modal', 'PostController@modalTest');

Route::get('products', 'ProductController@index');
Route::get('products/action', 'ProductController@action')->name('products.action');
