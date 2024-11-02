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

Route::get('test', function () {


});
    // ================> Ajax Routes <======================
    Route::get('/get-models/{id}', 'VehicleController@getModels')->name('vehicles.models');
    Route::get('/pull-vehicle-info/{vin}', 'VehicleController@pullInfo')->name('vehicles.pullInfo');
    Route::post('/upload-photos/{id}', 'VehicleController@updatePhotos')->name('vehicles.updatePhotos');
    Route::get('/get-vehicles/{client_id}/{port_id}','DockReceiptController@getVehicles')->name('dockReceipt.getVehicles');
    Route::post('/insert-vehicles/','DockReceiptController@insertVehicles')->name('dockReceipt.insertVehicles');

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

            // vehicles
            Route::resource('/vehicles', 'VehicleController')->parameters(['vehicles' => 'id']);
            Route::get('/vehicles-search', 'VehicleController@searchPages')->name('vehicles.search');
            Route::get('/static-vehicles-search', 'VehicleController@searchStaticPages')->name('static_vehicles.search');
            Route::post('/vehicles/upload_files/{id}', 'VehicleController@upload_files')->name('vehicles.upload_files');
            Route::delete('media-vehicles/{vehicle_id}/destroy/{id}', 'VehicleController@destroyMedia')->name('vehicles.media.destroy');

            // bookings
            Route::resource('/bookings', 'BookingController')->parameters(['bookings' => 'id']);
            Route::get('/bookings-search', 'BookingController@searchPages')->name('bookings.search');
            Route::get('/static-bookings-search', 'BookingController@searchStaticPages')->name('static_bookings.search');
            Route::post('/bookings/upload_files/{id}', 'BookingController@upload_files')->name('bookings.upload_files');
            Route::delete('media-bookings/{booking_id}/destroy/{id}', 'BookingController@destroyMedia')->name('bookings.media.destroy');
            Route::get('booking-close/{id}', 'BookingController@bookingClose')->name('bookings.close');
            // docks
            Route::resource('/docks', 'DockReceiptController')->parameters(['docks' => 'id']);
            Route::get('get-docks', 'DockReceiptController@getIndex')->name('docks.get.index');
            Route::get('get-load_plans', 'DockReceiptController@getloadplans')->name('docks.get.loadPlans');
            Route::get('/docks-search', 'DockReceiptController@searchPages')->name('docks.search');
            Route::get('/static-docks-search', 'DockReceiptController@searchStaticPages')->name('static_docks.search');
            Route::post('/docks/upload_files/{id}', 'DockReceiptController@upload_files')->name('docks.upload_files');
            Route::delete('media-docks/{dock_id}/destroy/{id}', 'DockReceiptController@destroyMedia')->name('docks.media.destroy');

            Route::get('workflow','WorkflowController@index')->name('workflow.index');

            // ============> General Settings <======================
            Route::group(['prefix'=>'warehouse'],function (){
                Route::group(['prefix'=>'general-settings'],function(){
                    Route::get('warehouseSwitch/{id}', 'SettingController@warehouseSwitch')->name('warehouse.general-settings.warehouseSwitch');
                });
            });
        });
    });
