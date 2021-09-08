<?php

namespace App\Repositories\Logs;

use App\Models\Log\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class LogRepository
{
    /**
     * @param int $id
     * @return Log
     */
    public function find(int $id): Log
    {
        return Log::find($id);
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(array $filters, string $ordering = 'DESC', int $pagination = 20): LengthAwarePaginator
    {
        $data = Log::orderBy('id', $ordering);

        if (isset($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        if (isset($filters['resource_type'])) {
            $data->where('resource_type', $filters['resource_type']);
        }

        return $data->paginate($pagination);
    }
}
