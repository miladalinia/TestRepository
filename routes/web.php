<?php


use App\Events\MyEvent;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'products', 'middleware' => ['auth']], function () {

    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('{product}', 'ProductController@show')->name('products.show');
    Route::get('create', 'ProductController@create')->name('products.create');
    Route::patch('{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::post('/', 'ProductController@store')->name('products.store');
    Route::post('/{product}', 'ProductController@update')->name('products.update');
    Route::delete('/{product}', 'ProductController@destroy')->name('products.destroy');

});

Route::get('users', 'UserController@index')->name('users.index');


Route::get('ajax', 'AjaxController@view');
Route::post('ajax', 'AjaxController@send_http_request')->name('ajaxRequest.post');

//Push notification with pusher
Route::get('test', function () {
    event(new MyEvent('آیا میخواهید نوتیفی برایتان بیاید؟'));
    return "Event has been sent!";
});

//Push notification with NotificationController
Route::get('notify','NotificationController@notify');
Route::view('/notification', 'notification');
