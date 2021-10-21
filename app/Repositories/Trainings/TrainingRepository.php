<?php

namespace App\Repositories\Trainings;

use App\Models\Trainings\Training;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TrainingRepository
{
    /**
     * @param int $id
     * @return Training|null
     */
    public function find(int $id): ?Training
    {
        return Training::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator|Collection|array
     */
    public function findBy(
        array  $filters = [],
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int    $pagination = 20
    ): LengthAwarePaginator|Collection|array
    {
        $data = Training::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['number']) && !empty($filters['name'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        if (isset($filters['is_all']) && $filters['is_all'] === true) {
            return $data->get();
        }

        return $data->paginate($pagination);
    }

    /**
     * @param array $filters
     * @return Training|null
     */
    public function findByOne(array $filters): ?Training
    {
        return Training::where($filters)->first();
    }
}
