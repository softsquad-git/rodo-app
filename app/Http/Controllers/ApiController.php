<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    protected function itemNoExist(): JsonResponse
    {
        return response()->json([
            'success' => 0,
            'message' => __('admin.notifications.no_exist')
        ], ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * @return JsonResponse
     */
    public function successResponse(): JsonResponse
    {
        return response()->json([
            'success' => 1,
            'message' => __('admin.notifications.success')
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function successRemoved(): JsonResponse
    {
        return response()->json([
            'success' => 1,
            'message' => __('admin.notifications.removed')
        ], ResponseAlias::HTTP_OK);
    }
}
