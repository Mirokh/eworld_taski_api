<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'AdminController@login');
Route::post('register', 'AdminController@register');
Route::get('auth', 'AdminController@auth')->middleware('auth:api');
Route::post('logout', 'AdminController@logout')->middleware('auth:api');

Route::get('categories', 'CategoryController@index');
Route::post('categories', 'CategoryController@create')->middleware('auth:api');
Route::put('categories/{category}', 'CategoryController@update')->middleware('auth:api');
Route::delete('categories/{category}', 'CategoryController@delete')->middleware('auth:api');

Route::get('products', 'ProductController@index');
Route::get('products/{category}/filter', 'ProductController@filter');
Route::get('products/{product}', 'ProductController@show');
Route::post('products', 'ProductController@create')->middleware('auth:api');
Route::post('products/{product}/update', 'ProductController@update')->middleware('auth:api');
Route::delete('products/{product}', 'ProductController@delete')->middleware('auth:api');


