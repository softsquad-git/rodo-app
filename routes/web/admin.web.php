<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'administration', 'namespace' => 'Admin'], function () {
    Route::get('', 'AdminController')
        ->name('admin.index');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController')
            ->name('admin.profile');
        Route::patch('update-avatar', 'ProfileController@updateAvatar')
            ->name('admin.update.avatar');
    });

    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
        Route::get('', 'SettingController')
            ->name('admin.settings.index');
    });

    Route::group(['prefix' => 'logs', 'namespace' => 'Logs'], function () {
       Route::get('', 'LogController@index')
           ->name('admin.logs.index');
       Route::delete('remove/{id}', 'LogController@remove')
           ->name('admin.logs.remove');
    });

    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        Route::get('', 'UserController@index')
            ->name('admin.users.index');
        Route::match(['get', 'post'], 'create', 'UserController@create')
            ->name('admin.users.create');
        Route::match(['get', 'post'], 'update/{id}', 'UserController@update')
            ->name('admin.users.update');
        Route::delete('remove/{id}', 'UserController@remove')
            ->name('admin.users.remove');
    });

    Route::group(['prefix' => 'clients', 'namespace' => 'Clients'], function () {
        Route::get('', 'ClientController@index')
            ->name('admin.clients.index');
        Route::match(['get', 'post'], 'create', 'ClientController@create')
            ->name('admin.clients.create');
        Route::match(['get', 'post'], 'update/{id}', 'ClientController@update')
            ->name('admin.clients.update');
        Route::delete('remove/{id}', 'ClientController@remove')
            ->name('admin.clients.remove');
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

           Route::group(['prefix' => 'types'], function () {
               Route::get('', 'TypeController@all')
                   ->name('api.admin.settings.types.list');
               Route::get('find', 'TypeController@find')
                   ->name('api.admin.settings.types.find');
               Route::post('create', 'TypeController@create')
                   ->name('api.admin.settings.types.create');
               Route::patch('update', 'TypeController@update')
                   ->name('api.admin.settings.types.update');
               Route::delete('remove', 'TypeController@remove')
                   ->name('api.admin.settings.types.remove');
           });
       });
    });
});
