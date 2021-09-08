<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => '/', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function () {
    include 'web/admin.web.php';
    include 'web/inspector.web.php';
    include 'web/user.web.php';
    include 'web/api.web.php';
});
