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

Route::post('login', 'AuthController@login');

Route::post('send-reset-otp', 'AuthController@sendResetOtp');
Route::post('verify-otp', 'AuthController@verifyOtp');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('rest-password', 'AuthController@resetPassword');
   /* =================> End Auth < ====================== */
    Route::get('branches', 'generalController@branches');
    Route::get('types', 'generalController@types');
    Route::get('makes', 'generalController@makes');
    Route::get('models/{id}', 'generalController@models');
    Route::get('colors', 'generalController@colors');
    Route::get('vehicles/{status}', 'VehicleController@index');
    Route::get('show/vehicle/{id}', 'VehicleController@show');
    Route::get('pull/vehicle-info/{id}', 'VehicleController@pullInfo');
    Route::post('store/vehicle', 'VehicleController@store');
    Route::post('search/vehicle', 'VehicleController@search');
    Route::post('set/arrival/vehicle/{id}', 'VehicleController@setArrival');
    Route::post('set/photos/vehicle/{id}', 'VehicleController@setPhotos');

    Route::get('containers','DockController@index');
    Route::post('set/loading/container/{id}', 'DockController@setLoading');
    Route::get('show/container/{id}', 'DockController@show');
    Route::post('search/container', 'DockController@search');
    Route::post('set/photos/container/{id}', 'DockController@setPhotos');



});
