<?php

namespace App\Http\Controllers\Inspector\RiskAnalysis;

use App\Http\Controllers\ApiController;
use App\Http\Requests\RiskAnalysis\SecurityRequest;
use App\Http\Resources\RiskAnalysis\SecurityResource;
use App\Models\RiskAnalysis\Security;
use App\Repositories\RiskAnalysis\SecurityRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\RiskAnalysis\SecurityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SecurityController extends ApiController
{
    /**
     * @param SecurityRepository $securityRepository
     * @param SecurityService $securityService
     * @param StatusRepository $statusRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(
        private SecurityRepository $securityRepository,
        private SecurityService    $securityService,
        private StatusRepository   $statusRepository,
        private TypeRepository     $typeRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.risk_analysis.security.index', [
            'title' => __('inspector.risk_analysis.security.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->securityRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return SecurityResource::collection($data);
    }

    /**
     * @param SecurityRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(SecurityRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->securityService->save($request->all());

            return redirect()->route('inspector.risk_analysis.security.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.risk_analysis.security.form', [
            'title' => __('inspector.risk_analysis.security.form.create.title'),
            'item' => new Security(),
            'statuses' => $this->statusRepository->findAll(Security::$resourceType),
            'types' => $this->typeRepository->findAll(Security::$resourceType)
        ]);
    }

    /**
     * @param SecurityRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(SecurityRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->securityRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->securityService->save($request->all(), $item);

            return redirect()->route('inspector.risk_analysis.security.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.risk_analysis.security.form', [
            'title' => __('inspector.risk_analysis.security.form.edit.title'),
            'item' => $item,
            'statuses' => $this->statusRepository->findAll(Security::$resourceType),
            'types' => $this->typeRepository->findAll(Security::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->securityRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->securityService->remove($item);

        return $this->successRemoved();
    }
}
