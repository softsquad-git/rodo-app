<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function () {
    Route::get('/', function () {

    });
    include 'web/admin.web.php';
    include 'web/inspector.web.php';
    include 'web/user.web.php';
    include 'web/employee.web.php';
    include 'web/api.web.php';
});
