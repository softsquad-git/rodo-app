<?php

namespace App\Repositories\Trainings\Tests;

use App\Models\Tests\TestQuestion;
use Illuminate\Pagination\LengthAwarePaginator;

class TestQuestionRepository
{
    /**
     * @param int $id
     * @return TestQuestion|null
     */
    public function find(int $id): ?TestQuestion
    {
        return TestQuestion::find($id);
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
        $data = TestQuestion::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $data->paginate($pagination);
    }

    public function findAll()
    {
        return TestQuestion::all();
    }
}
