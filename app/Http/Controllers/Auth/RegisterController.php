<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use App\Services\Auth\AuthService;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Exception;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Contracts\Validation\Validator as RequestValidator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @param AuthService $authService
     * @return void
     */
    public function __construct(
        private AuthService $authService
    )
    {
        $this->middleware('guest');
    }

    /**
     * @param array $data
     * @return RequestValidator
     */
    protected function validator(array $data): RequestValidator
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param array $data
     * @return User
     * @throws Exception
     */
    protected function create(array $data): User
    {
        return $this->authService->register($data);
    }
}
