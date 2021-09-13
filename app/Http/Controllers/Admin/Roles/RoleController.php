<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Roles\RoleRequest;
use App\Http\Resources\Roles\RoleResource;
use App\Models\Roles\Role;
use App\Repositories\Roles\RoleRepository;
use App\Services\Roles\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends ApiController
{
    /**
     * @param RoleRepository $roleRepository
     * @param RoleService $roleService
     */
    public function __construct(
        private RoleRepository $roleRepository,
        private RoleService $roleService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.roles.index', [
            'title' => __('admin.roles.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->roleRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return RoleResource::collection($data);
    }

    /**
     * @param RoleRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(RoleRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->roleService->save($request->all());

            return redirect()->route('admin.roles.index')
                ->with('notification.success', __('notifications.success.created'));
        }

        return view('admin.roles.form', [
            'item' => new Role(),
            'title' => __('admin.roles.form.create.title')
        ]);
    }

    /**
     * @param RoleRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(RoleRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var Role $item
         */
        $item = $this->objectNoExist($this->roleRepository->find($id));
        if ($request->isMethod('POST')) {
            $this->roleService->save($request->all(), $item);

            return redirect()->route('admin.roles.index')
                ->with('notification.success', __('notifications.success.updated'));
        }

        return view('admin.roles.form', [
            'item' => $item,
            'title' => __('admin.roles.form.edit.title')
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->roleRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->roleService->remove($item);

        return $this->successRemoved();
    }
}
