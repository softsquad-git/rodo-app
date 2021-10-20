<?php

namespace App\Repositories\Datasets;

use App\Models\DataSets\Dataset;
use Illuminate\Pagination\LengthAwarePaginator;

class DatasetRepository
{
    /**
     * @param int $id
     * @return Dataset
     */
    public function find(int $id): Dataset
    {
        return Dataset::find($id);
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
        $data = Dataset::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
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
