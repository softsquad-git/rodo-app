<?php

namespace App\Repositories\RCP;

use App\Models\RCP\LawBasic;
use Illuminate\Pagination\LengthAwarePaginator;

class LawBasicRepository
{
    /**
     * @param int $id
     * @return LawBasic|null
     */
    public function find(int $id): ?LawBasic
    {
        return LawBasic::find($id);
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
        $data = LawBasic::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['count']) && !empty($filters['count'])) {
            $data->where('count', $filters['count']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        return $data->paginate($pagination);
    }
}
