<?php

namespace App\Http\Controllers\Employee\Applications;

use App\Http\Controllers\ApiController;
use App\Repositories\Settings\StatusRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ApplicationController extends ApiController
{
    public function __construct(
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.applications.index', [
            'title' => __('employee.applications.title')
        ]);
    }
}
