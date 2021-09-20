<?php

namespace App\Repositories\Trainings\Tests;

use App\Models\Tests\Test;
use Illuminate\Pagination\LengthAwarePaginator;

class TestRepository
{
    /**
     * @param int $id
     * @return Test|null
     */
    public function find(int $id): ?Test
    {
        return Test::find($id);
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
        $data = Test::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['group_id']) && !empty($filters['group_id'])) {
            $data->where('group_id', $filters['group_id']);
        }

        return $data->paginate($pagination);
    }

    public function findAll()
    {
        return Test::all();
    }
}
