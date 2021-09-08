<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Repositories\Logs\LogRepository;
use App\Services\Log\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;

class LogController extends Controller
{
    /**
     * @param LogRepository $logRepository
     * @param LogService $logService
     */
    public function __construct(
        private LogRepository $logRepository,
        private LogService $logService
    )
    {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $data = $this->logRepository->findBy(
            $request->only(['resource_type', 'user_id']),
            $this->checkOrdering($request->get('ordering', 'DESC')),
            $request->get('pagination', 20)
        );

        return view('admin.logs.index', [
            'data' => $data,
            'title' => __('admin.logs.title')
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse
    {
        /**
         * @var Log|null $item
         */
        $item = $this->objectNoExist($this->logRepository->find($id));
        $this->logService->remove($item);

        return redirect()->back()
            ->with('notification.success', __('notifications.success.removed'));
    }
}
