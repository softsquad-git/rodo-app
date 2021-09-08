<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
   Route::get('get-data-gus', 'GusController')
       ->name('api.get_gus_data');
});
