<?php

namespace App\Repositories\Assets;

use App\Models\Assets\SystemIt;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemItRepository
{
    /**
     * @param int $id
     * @return SystemIt|null
     */
    public function find(int $id): ?SystemIt
    {
        return SystemIt::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filters = [],
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int    $pagination = 20
    ): LengthAwarePaginator
    {
        $data = SystemIt::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['symbol']) && !empty($filters['symbol'])) {
            $data->where('symbol', $filters['symbol']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['owner']) && !empty($filters['owner'])) {
            $data->where('owner', $filters['owner']);
        }

        if (isset($filters['type_id']) && !empty($filters['type_id'])) {
            $data->where('type_id', $filters['type_id']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        return $data->paginate($pagination);
    }
}
