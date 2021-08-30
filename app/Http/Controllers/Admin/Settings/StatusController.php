<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Repositories\Settings\StatusRepository;
use App\Services\Settings\StatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Exception;

class StatusController extends Controller
{
    /**
     * @param StatusRepository $statusRepository
     * @param StatusService $statusService
     */
    public function __construct(
        private StatusRepository $statusRepository,
        private StatusService $statusService
    )
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
        $status = $this->statusRepository->findAll();

        return StatusResource::collection($status);
    }

    /**
     * @param Request $request
     * @return StatusResource|JsonResponse
     * @throws Exception
     */
    public function find(Request $request): StatusResource|JsonResponse
    {
        $item = $this->statusRepository->find($request->get('id'));
        if (!$item) {
            return response()->json([
                'success' => 0,
                'message' => __('api.notification.no_exist')
            ], 401);
        }

        return new StatusResource($item);
    }

    /**
     * @param StatusRequest $request
     * @return JsonResponse
     */
    public function create(StatusRequest $request): JsonResponse
    {
        $this->statusService->save($request->all());

        return response()->json([
            'success' => 1,
            'message' => __('api.notification.created')
        ], 201);
    }

    /**
     * @param StatusRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function update(StatusRequest $request): JsonResponse
    {
        $data = $request->all();
        $item = $this->statusRepository->find($data['id']);
        if (!$item) {
            return response()->json([
                'success' => 0,
                'message' => __('api.notification.no_exist')
            ], 401);
        }

        $this->statusService->save($request->all(), $item);

        return response()->json([
            'success' => 1,
            'message' => __('api.notification.updated')
        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function remove(Request $request): JsonResponse
    {
        $ids = $request->query->get('ids');
        $ids = json_decode($ids, true);
        foreach ($ids as $id) {
            $item = $this->statusRepository->find($id);
            if ($item) {
                $this->statusService->remove($item);
            }
        }

        return response()->json([
            'success' => 1,
            'message' => __('api.notification.removed')
        ], 200);
    }
}
