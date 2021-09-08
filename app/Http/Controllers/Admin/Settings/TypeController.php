<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Types\TypeRequest;
use App\Http\Resources\TypesResource;
use App\Repositories\Settings\TypeRepository;
use App\Services\Settings\TypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TypeController extends Controller
{
    /**
     * @param TypeRepository $typeRepository
     * @param TypeService $typeService
     */
    public function __construct(
        private TypeRepository $typeRepository,
        private TypeService $typeService
    )
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $types = $this->typeRepository->findBy($request->all());

        return TypesResource::collection($types);
    }

    /**
     * @param Request $request
     * @return TypesResource|JsonResponse
     */
    public function find(Request $request): TypesResource|JsonResponse
    {
        $item = $this->typeRepository->find($request->get('id'));
        if (!$item) {
            return response()->json([
                'success' => 0,
                'message' => __('api.notification.no_exist')
            ], 404);
        }

        return new TypesResource($item);
    }

    /**
     * @param TypeRequest $request
     * @return JsonResponse
     */
    public function create(TypeRequest $request): JsonResponse
    {
        $this->typeService->save($request->all());

        return response()->json([
            'success' => 1,
            'message' => __('api.notification.created')
        ], 201);
    }

    /**
     * @param TypeRequest $request
     * @return JsonResponse
     */
    public function update(TypeRequest $request): JsonResponse
    {
        $data = $request->all();
        $item = $this->typeRepository->find($data['id']);
        if (!$item) {
            return response()->json([
                'success' => 0,
                'message' => __('api.notification.no_exist')
            ], 404);
        }

        $this->typeService->save($data, $item);

        return response()->json([
            'success' => 1,
            'message' => __('api.notification.updated')
        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request): JsonResponse
    {
        $ids = $request->query->get('ids');
        $ids = json_decode($ids, true);
        foreach ($ids as $id) {
            $item = $this->typeRepository->find($id);
            if ($item) {
                $this->typeService->remove($item);
            }
        }

        return response()->json([
            'success' => 1,
            'message' => __('api.notification.removed')
        ], 200);
    }
}
