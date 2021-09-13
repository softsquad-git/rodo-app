<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Repositories\Settings\StatusRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InspectorController extends Controller
{
    public function __construct(
        private StatusRepository $statusRepository
    )
    {
    }

    public function __invoke()
    {
        return view('inspector.index', [
            'title' => __('inspector.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function getStatuses(Request $request): AnonymousResourceCollection
    {
        $data = $this->statusRepository->findAll($request->get('resource_type'));

        return StatusResource::collection($data);
    }
}
