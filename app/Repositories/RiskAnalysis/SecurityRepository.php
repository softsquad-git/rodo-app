<?php

namespace App\Repositories\RiskAnalysis;

use App\Models\RiskAnalysis\Security;
use Illuminate\Pagination\LengthAwarePaginator;

class SecurityRepository
{
    /**
     * @param int $id
     * @return Security|null
     */
    public function find(int $id): ?Security
    {
        return Security::find($id);
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
        $data = Security::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['type']) && !empty($filters['type'])) {
            $data->where('type', $filters['type']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        return $data->paginate($pagination);
    }
}
