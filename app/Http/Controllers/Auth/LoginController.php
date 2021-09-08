<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        $this->setAction(Log::$actions['login'])
            ->setIpAddress($request->getClientIp())
            ->setUserId($user->id)
            ->setResourceId(null)
            ->setResourceType(null)
            ->save();
    }
}
