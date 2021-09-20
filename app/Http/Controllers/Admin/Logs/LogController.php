<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Repositories\Logs\LogRepository;
use App\Services\Log\LogService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LogController extends Controller
{
    /**
     * @param LogRepository $logRepository
     * @param LogService $logService
     */
    public function __construct(
        private LogRepository $logRepository,
        private LogService    $logService
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

    /**
     * @param Request $request
     * @return StreamedResponse
     */
    public function download(Request $request): StreamedResponse
    {
        $data = $this->logRepository->findBy(['from' => $request->get('from'), 'to' => $request->get('to')]);

        $filename = Carbon::now() . '-logs.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['IP adres', 'Użytkownik', 'Akcja', 'Element', 'Czas'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $item) {
                $row['IP adres'] = $item->ip_address;
                $row['Użytkownik'] = $item->user?->name;
                $row['Akcja'] = __('trans.actions.' . $item->action);
                $row['Element'] = '';
                $row['Czas'] = $item->created_at;

                fputcsv($file, [$row['IP adres'], $row['Użytkownik'], $row['Akcja'], $row['Element'], $row['Czas']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
