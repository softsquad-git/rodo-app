<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Role;
use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $this->setAction(Log::$actions['login'])
            ->setIpAddress($request->getClientIp())
            ->setUserId($user->id)
            ->setResourceId(null)
            ->setResourceType(null)
            ->save();

        if ($user->role == Role::$role['ADMIN']) {
            return redirect()->route('admin.index');
        }
        if ($user->role == Role::$role['INSPECTOR']) {
            return redirect()->route('inspector.index');
        }
    }
}
