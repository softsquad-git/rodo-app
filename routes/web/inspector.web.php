<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'inspector', 'namespace' => 'Inspector'], function () {
    Route::get('', 'InspectorController')
        ->name('inspector.index');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController')
            ->name('inspector.profile');
        Route::patch('update-avatar', 'ProfileController@updateAvatar')
            ->name('inspector.update.avatar');
    });

    Route::group(['prefix' => 'tasks', 'namespace' => 'Tasks'], function () {
        Route::get('', 'TaskController')
            ->name('inspector.tasks.index');
        Route::match(['get', 'post'], 'create', 'TaskController@create')
            ->name('inspector.tasks.create');
        Route::match(['get', 'post'], 'update/{id}', 'TaskController@update')
            ->name('inspector.tasks.update');
    });


    Route::group(['prefix' => 'api'], function () {
        Route::get('get-statuses', 'InspectorController@getStatuses');

        Route::group(['prefix' => 'tasks', 'namespace' => 'Tasks'], function () {
           Route::get('', 'TaskController@all')
               ->name('api.inspector.tasks.list');
           Route::delete('remove/{id}', 'TaskController@remove');
        });

    });
});
