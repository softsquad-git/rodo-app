<?php

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\Role;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Users\UserRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Users\UserRepository;
use App\Services\Users\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Exception;

class UserController extends ApiController
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService $userService,
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.users.index', [
            'title' => __('admin.users.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $filters = $request->all();
        $filters['role'] = Role::$role['INSPECTOR'];

        $data = $this->userRepository->findBy(
            $filters,
            $this->checkOrdering($request->get('ordering', 'DESC')),
            $request->get('pagination', 20)
        );

        return UserResource::collection($data);
    }

    /**
     * @param UserRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(UserRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->userService->create($request->all());

            return redirect()->route('admin.users.index')
                ->with('notification.success', __('notifications.success.created'));
        }

        return \view('admin.users.form', [
            'item' => new User(),
            'title' => __('admin.users.form.create.title'),
            'statuses' => $this->statusRepository->findAll('inspector')
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
            'title' => __('admin.users.form.update.title'),
            'statuses' => $this->statusRepository->findAll()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        /**
         * @var User $item
         */
        $item = $this->objectNoExist($this->userRepository->find($id));

        if (!$item) {
            return $this->itemNoExist();
        }

        $this->userService->remove($item);

        return $this->successRemoved();
    }
}
