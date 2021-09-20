<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingAvatarRequest;
use App\Http\Requests\Settings\SettingBasicDataRequest;
use App\Http\Requests\Settings\SettingPasswordRequest;
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

    public function updateBasicData(SettingBasicDataRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $this->objectNoExist($this->userRepository->find(Auth::id()));
        $this->userService->updateBasicData($request->only('first_name', 'last_name', 'email'), $user);

        return redirect()->back()
            ->with('notification.success', __('notifications.success.updated'));
    }

    /**
     * @param SettingPasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(SettingPasswordRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $this->objectNoExist($this->userRepository->find(Auth::id()));

        $is = $this->userService->updatePassword($request->only('old_password', 'new_password'), $user);
        if (!$is) {
            return redirect()->back()->with('notification.error', 'Obecne hasło jest nieprawidłowe');
        }

        return redirect()->back()
            ->with('notification.success', __('notifications.success.updated'));
    }
}
