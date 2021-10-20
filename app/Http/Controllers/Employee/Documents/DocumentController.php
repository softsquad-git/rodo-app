<?php

namespace App\Http\Controllers\Employee\Documents;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Documents\DocumentsResource;
use App\Repositories\Documents\DocumentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DocumentController extends ApiController
{
    public function __construct(
        private DocumentRepository $documentRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.documents.index', [
            'title' => __('employee.documents.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $filters = $request->all();
        $filters['user_id'] = Auth::id();

        $data = $this->documentRepository->findBy(
            $filters
        );

        return DocumentsResource::collection($data);
    }
}
