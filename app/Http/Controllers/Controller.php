<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param object|null $object
     * @return RedirectResponse|object
     */
    protected function objectNoExist(?object $object)
    {
        if (!$object) {
            return redirect()->back()
                ->with('notifications.error.object_no_exist');
        }

        return $object;
    }
}
