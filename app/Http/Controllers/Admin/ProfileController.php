<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingAvatarRequest;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use App\Services\Users\UserService;
use \Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;
use \Exception;

class ProfileController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService    $userService
    )
    {
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function __invoke(): Application|Factory|View|RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $this->objectNoExist($this->userRepository->find(Auth::id()));

        return view('admin.profile', [
            'user' => $user,
            'title' => $user->name
        ]);
    }

    /**
     * @param SettingAvatarRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function updateAvatar(SettingAvatarRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $this->objectNoExist($this->userRepository->find(Auth::id()));

        $data = $request->only(['avatar']);
        $this->userService->updateAvatar($data, $user);

        return redirect()->back()
            ->with('notification.success', __('notifications.success.updated'));
    }
}
