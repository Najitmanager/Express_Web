<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
            [
                'prefix' => LaravelLocalization::setLocale(),
                'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
            ], function(){

            Route::group(['prefix' => env('PREFIX_ADMIN', 'admin')], function () {

                // Route::get('/link-storage', function () {
                //     \Artisan::call('storage:link');
                // });

                // auth routes
                require __DIR__.'/auth.php';


                Route::middleware('auth')->namespace('Admin')->group(function () {
                    Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
                    Route::post('/dashboard', 'HomeController@store');
                    // Settings routes
                    Route::get('/settings/general', 'SettingsController@index')->name('admin.settings');
                    Route::put('/settings/general', 'SettingsController@update')->name('setting.update');
                    Route::get('/settings/notifications', 'NotificationsSettingsController@index')->name('admin.settings.notifications');
                    Route::put('/settings/notifications', 'NotificationsSettingsController@update')->name('notificationsetting.update');

                    Route::get('/settings/google', 'GoogleSettingsController@index')->name('admin.settings.google');
                    Route::put('/settings/google', 'GoogleSettingsController@update')->name('googlesetting.update');

                    Route::get('/settings/active-theme', 'ThemeSettingController@defaultTheme')->name('default-theme.edit');
                    Route::post('/settings/active-theme', 'ThemeSettingController@activeTheme')->name('active-theme.edit');

                    Route::get('/settings/theme/{place}', 'ThemeSettingController@edit')->name('theme-setting.edit');
                    Route::put('/settings/theme/{place}', 'ThemeSettingController@update')->name('theme-setting.update');


                    Route::get('/notifications', 'NotificationsSettingsController@notifications')->name('notifications');
                    Route::get('/notifications/{id}', 'NotificationsSettingsController@notification')->name('notification.view');

                    Route::get('/system-update', 'SystemController@getSystemUpdate')->name('system.update');
                    Route::post('/system-update', 'SystemController@postSystemUpdate')->name('post.system.update');

                    Route::get('/addons', 'AddonsController@addons')->name('addons');
                    Route::get('/addon-upload', 'AddonsController@getAddonUpload')->name('addon.upload');
                    Route::post('/addon-upload', 'AddonsController@postAddonUpload')->name('post.addon.upload');
                    Route::post('/changing-status', 'AddonsController@changingStatus')->name('postchangingstatus');
                    Route::post('/delete-addons/{id}', 'AddonsController@deleteAddons')->name('delete.addons');

                    Route::post('/import-demo', 'ThemeSettingController@importDemo')->name('import.demo');

                });
            });
        });

