<?php

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use App\Services\Users\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService $userService
    )
    {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $filters = $request->all();
        $filters['role'] = Role::$role['INSPECTOR'];

        $data = $this->userRepository->findBy(
            $filters,
            $this->checkOrdering($request->get('ordering', 'DESC')),
            $request->get('pagination', 20)
        );

        return view('admin.users.index', [
            'data' => $data,
            'title' => __('admin.users.title')
        ]);
    }

    public function create(UserRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->userService->create($request->all());

            return redirect()->route('admin.users.index')
                ->with('notification.success', __('notifications.success.created'));
        }

        return \view('admin.users.form', [
            'item' => new User(),
            'title' => __('admin.users.form.create.title')
        ]);
    }

    /**
     * @param UserRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(UserRequest $request, int $id):Application|Factory|View|RedirectResponse
    {
        $item = $this->userRepository->find($id);
        if ($request->isMethod('POST')) {
            $this->userService->update($request->all(), $item);

            return redirect()->route('admin.users.index')
                ->with('notification.success', __('notifications.success.updated'));
        }

        return \view('admin.users.form', [
            'item' => $item,
            'title' => __('admin.users.form.update.title')
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse
    {
        /**
         * @var User $item
         */
        $item = $this->objectNoExist($this->userRepository->find($id));
        $this->userService->remove($item);

        return redirect()->route('admin.users.index')
            ->with('notification.success', __('notifications.success.removed'));
    }
}
