<?php

namespace App\Http\Controllers\Inspector\Newsletter;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Newsletter\NewsletterPostRequest;
use App\Http\Resources\Newsletter\NewsletterPostResource;
use App\Models\Newsletter\NewsletterPost;
use App\Repositories\Clients\ClientRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Newsletter\NewsletterPostRepository;
use App\Services\Newsletter\NewsletterPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;
use Exception;

class NewsletterPostController extends ApiController
{
    /**
     * @param NewsletterPostService $newsletterPostService
     * @param StatusRepository $statusRepository
     * @param NewsletterPostRepository $newsletterPostRepository
     * @param ClientRepository $clientRepository
     */
    public function __construct(
        private NewsletterPostService    $newsletterPostService,
        private StatusRepository         $statusRepository,
        private NewsletterPostRepository $newsletterPostRepository,
        private ClientRepository         $clientRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.newsletter.index', [
            'title' => __('inspector.newsletter.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->newsletterPostRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return NewsletterPostResource::collection($data);
    }

    /**
     * @param NewsletterPostRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(NewsletterPostRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->newsletterPostService->save($request->all());

            return redirect()->route('inspector.newsletter.index')
                ->with('notification.success', __('inspector.notifications.created'));
        }

        return view('inspector.newsletter.form', [
            'item' => new NewsletterPost(),
            'title' => __('inspector.newsletter.form.create.title'),
            'statuses' => $this->statusRepository->findAll(NewsletterPost::$resourceType),
            'clients' => $this->clientRepository->findAll()
        ]);
    }

    /**
     * @param NewsletterPostRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(NewsletterPostRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->newsletterPostRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->newsletterPostService->save($request->all(), $item);

            return redirect()->route('inspector.newsletter.index')
                ->with('notification.success', __('inspector.notifications.updated'));
        }

        return view('inspector.newsletter.form', [
            'item' => $item,
            'title' => __('inspector.newsletter.form.edit.title'),
            'statuses' => $this->statusRepository->findAll(NewsletterPost::$resourceType),
            'clients' => $this->clientRepository->findAll()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->newsletterPostRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->newsletterPostService->remove($item);

        return $this->successRemoved();
    }
}
