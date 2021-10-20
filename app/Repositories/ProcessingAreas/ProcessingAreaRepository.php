<?php

namespace App\Repositories\ProcessingAreas;

use App\Models\ProcessingAreas\ProcessingArea;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcessingAreaRepository
{
    /**
     * @param int $id
     * @return ProcessingArea|null
     */
    public function find(int $id): ?ProcessingArea
    {
        return ProcessingArea::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array $filters,
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int $pagination = 20
    ): LengthAwarePaginator
    {
        $data = ProcessingArea::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $data->paginate($pagination);
    }
}
