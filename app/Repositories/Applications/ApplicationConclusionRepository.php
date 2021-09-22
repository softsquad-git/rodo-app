<?php

namespace App\Repositories\Applications;

use App\Models\Applications\ApplicationConclusion;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationConclusionRepository
{
    /**
     * @param int $id
     * @return ApplicationConclusion
     */
    public function find(int $id): ApplicationConclusion
    {
        return ApplicationConclusion::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filters,
        string $orderingColumn,
        string $orderingSort,
        int    $pagination
    ): LengthAwarePaginator
    {
        $data = ApplicationConclusion::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['title']) && !empty($filters['title'])) {
            $data->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['type_id']) && !empty($filters['type_id'])) {
            $data->where('type_id', $filters['type_id']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        if (isset($filters['is_accepted']) && !empty($filters['is_accepted'])) {
            $data->where('is_accepted', $filters['is_accepted']);
        }

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        return $data->paginate($pagination);
    }
}
