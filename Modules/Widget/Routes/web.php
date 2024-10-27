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

use Illuminate\Support\Facades\Route;


    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){

        Route::middleware(['auth', 'warehouseSwitch'])->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

            Route::get('/widgets', 'WidgetController@index')->name('widgets.index');
            Route::put('/widgets', 'WidgetController@update')->name('widgets.update');

        });
    });

