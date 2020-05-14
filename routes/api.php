<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('products', 'ProductController@products_api');
Route::get('products/{id}', 'ProductController@productsById_api');
Route::post('products', 'ProductController@createProducts_api');
Route::put('products/{id}', 'ProductController@updateProducts_api');
Route::delete('products/{id}', 'ProductController@deleteProducts_api');


