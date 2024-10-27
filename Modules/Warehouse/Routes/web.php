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
            // ports
            Route::resource('/ports', 'PortController')->parameters(['ports' => 'id'])->except(['show']);
            Route::delete('/ports-multi-destroy', 'PortController@multiDestroy')->name('ports.multi-destroy');
            Route::get('/ports-search', 'PortController@searchPages')->name('ports.search');
            Route::get('/static-ports-search', 'PortController@searchStaticPages')->name('static_ports.search');
            Route::post('/ports/update_active', 'PortController@update_active')->name('ports.update_active');

            // carriers
            Route::resource('/carriers', 'CarrierController')->parameters(['carriers' => 'id'])->except(['show']);
            Route::delete('/carriers-multi-destroy', 'CarrierController@multiDestroy')->name('carriers.multi-destroy');
            Route::get('/carriers-search', 'CarrierController@searchPages')->name('carriers.search');
            Route::get('/static-carriers-search', 'CarrierController@searchStaticPages')->name('static_carriers.search');
            Route::post('/carriers/update_active', 'CarrierController@update_active')->name('carriers.update_active');

            // consignees
            Route::resource('/consignees', 'ConsigneeController')->parameters(['consignees' => 'id'])->except(['show']);
            Route::delete('/consignees-multi-destroy', 'ConsigneeController@multiDestroy')->name('consignees.multi-destroy');
            Route::get('/consignees-search', 'ConsigneeController@searchPages')->name('consignees.search');
            Route::get('/static-consignees-search', 'ConsigneeController@searchStaticPages')->name('static_consignees.search');
            Route::post('/consignees/update_active', 'ConsigneeController@update_active')->name('consignees.update_active');

            // truck Companies
            Route::resource('/truck_companies', 'TruckCompanyController')->parameters(['truck_companies' => 'id'])->except(['show']);
            Route::delete('/truck_companies-multi-destroy', 'TruckCompanyController@multiDestroy')->name('truck_companies.multi-destroy');
            Route::get('/truck_companies-search', 'TruckCompanyController@searchPages')->name('truck_companies.search');
            Route::get('/static-truck_companies-search', 'TruckCompanyController@searchStaticPages')->name('static_truck_companies.search');
            Route::post('/truck_companies/update_active', 'TruckCompanyController@update_active')->name('truck_companies.update_active');
            Route::post('/truck_companies/upload_files/{id}', 'TruckCompanyController@upload_files')->name('truck_companies.upload_files');
            Route::delete('media-truck_companies/{truck_company_id}/destroy/{id}', 'TruckCompanyController@destroyMedia')->name('truck_companies.media.destroy');

            // Customers
            Route::resource('/customers', 'CustomerController')->parameters(['customers' => 'id'])->except(['show']);
            Route::delete('/customers-multi-destroy', 'CustomerController@multiDestroy')->name('customers.multi-destroy');
            Route::get('/customers-search', 'CustomerController@searchPages')->name('customers.search');
            Route::get('/static-customers-search', 'CustomerController@searchStaticPages')->name('static_customers.search');
            Route::post('/customers/update_active', 'CustomerController@update_active')->name('customers.update_active');
            Route::post('/customers/upload_files/{id}', 'CustomerController@upload_files')->name('customers.upload_files');
            Route::delete('media-customers/{customer_id}/destroy/{id}', 'CustomerController@destroyMedia')->name('customers.media.destroy');
            Route::post('price-store/{customer_id}','CustomerController@priceStore')->name('customers.price.store');
            Route::delete('price-destroy/{customer_id}/{id}','CustomerController@priceStore')->name('customers.price.destroy');

            // ============> General Settings <======================
            Route::group(['prefix'=>'warehouse'],function (){
                Route::group(['prefix'=>'general-settings'],function(){
                    Route::get('warehouseSwitch/{id}', 'SettingController@warehouseSwitch')->name('warehouse.general-settings.warehouseSwitch');
                });
            });
        });
    });
