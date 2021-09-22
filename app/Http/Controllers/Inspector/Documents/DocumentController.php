<?php

namespace App\Http\Controllers\Inspector\Documents;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Documents\DocumentRequest;
use App\Http\Resources\Documents\DocumentsResource;
use App\Models\Documents\Document;
use App\Repositories\Documents\DocumentRepository;
use Illuminate\Http\RedirectResponse;
use App\Services\Documents\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Exception;

class DocumentController extends ApiController
{
    /**
     * @param DocumentRepository $documentRepository
     * @param DocumentService $documentService
     */
    public function __construct(
        private DocumentRepository $documentRepository,
        private DocumentService    $documentService,
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.documents.index', [
            'title' => __('inspector.documents.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->documentRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return DocumentsResource::collection($data);
    }

    /**
     * @param DocumentRequest $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(DocumentRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->documentService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.documents.form', [
            'item' => new Document(),
            'title' => __('inspector.documents.form.create.title')
        ]);
    }

    /**
     * @param DocumentRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function update(DocumentRequest $request, int $id): Application|Factory|View|JsonResponse|RedirectResponse
    {
        $item = $this->documentRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->documentService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.documents.form', [
            'item' => $item,
            'title' => __('inspector.documents.form.edit.title')
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->documentRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->documentService->remove($item);

        return $this->successRemoved();
    }
}
