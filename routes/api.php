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

Route::group(array('prefix' => 'v1', 'middleware' => []), function(){
    Route::post('getCountryNames', 'getController@getCountryNames');
    Route::post('getCityNames', 'getController@getCityNames');
    Route::post('getSubCityNames', 'getController@getSubCityNames');
    Route::post('getBookCategory', 'getController@getBookCategory');
    Route::post('getBookSubCategory', 'getController@getBookSubCategory');
    Route::post('getBookAdByBookName', 'getController@getBookAdByBookName');

});
