<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use \Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;

class ProfileController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function __invoke(): Application|Factory|View|RedirectResponse
    {
        /**
         * @var User|null $user
         */
        $user = $this->objectNoExist($this->userRepository->find(Auth::id()));

        return view('admin.profile', [
            'user' => $user,
            'title' => $user->name
        ]);
    }
}
