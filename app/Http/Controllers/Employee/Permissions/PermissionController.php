<?php

namespace App\Http\Controllers\Employee\Permissions;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PermissionController extends ApiController
{
    public function __construct()
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.permissions.index', [
            'title' => __('employee.permissions.title')
        ]);
    }
}
