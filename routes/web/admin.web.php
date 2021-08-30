<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'administration', 'namespace' => 'Admin'], function () {
    Route::get('', 'AdminController')
        ->name('admin.index');
    Route::get('profile', 'ProfileController')
        ->name('admin.profile');
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        Route::get('', 'SettingController')
            ->name('admin.settings.index');
    });

    Route::group(['prefix' => 'api'], function () {
       Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
          Route::get('', 'SettingController@getSettingsList')
              ->name('api.admin.settings.list');

           Route::group(['prefix' => 'status'], function () {
                Route::get('', 'StatusController@all')
                    ->name('api.admin.settings.status.list');
                Route::get('find', 'StatusController@find')
                    ->name('api.admin.settings.status.find');
                Route::post('create', 'StatusController@create')
                    ->name('api.admin.settings.status.create');
                Route::patch('update', 'StatusController@update')
                    ->name('api.admin.settings.status.update');
                Route::delete('remove', 'StatusController@remove')
                    ->name('api.admin.settings.status.remove');
           });
       });
    });
});
