<?php

namespace App\Http\Controllers;

use App\Traits\UserLog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, UserLog;

    /**
     * @param object|null $object
     * @return RedirectResponse|object
     */
    protected function objectNoExist(?object $object)
    {
        if (!$object) {
            return redirect()->back()
                ->with('notification.error', __('notifications.error.object_no_exist'));
        }

        return $object;
    }

    /**
     * @param string $ordering
     * @return string
     */
    protected function checkOrdering(string $ordering): string
    {
        if ($ordering != 'DESC' && $ordering != 'desc' && $ordering != 'ASC' && $ordering != 'asc') {
            return 'DESC';
        }

        return $ordering;
    }
}
