<?php

namespace App\Repositories\Trainings;

use App\Models\Trainings\TrainingGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TrainingGroupRepository
{
    /**
     * @param int $id
     * @return TrainingGroup|null
     */
    public function find(int $id): ?TrainingGroup
    {
        return TrainingGroup::find($id);
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
        string $orderingColumn,
        string $orderingSort,
        int $pagination
    ): LengthAwarePaginator
    {
        $data = TrainingGroup::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        return $data->paginate($pagination);
    }

    /**
     * @return Collection|array
     */
    public function findAll(): Collection|array
    {
        return TrainingGroup::all();
    }
}
