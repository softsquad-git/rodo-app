<?php

namespace App\Repositories\Tasks;

use App\Models\Tasks\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository
{
    /**
     * @param int $id
     * @return Task|null
     */
    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    public function findBy(
        array $filters = [],
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int $pagination = 20
    ): LengthAwarePaginator
    {
        $data = Task::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['deadline']) && !empty($filters['deadline'])) {
            $data->where('deadline', '<', $filters['deadline']);
        }

        if (isset($filters['status']) && !empty($filters['status'])) {
            $data->where('status_id', $filters['status']);
        }

        return $data->paginate($pagination);
    }

    /**
     * @param array $filters
     * @return Task|null
     */
    public function findByOne(array $filters): ?Task
    {
        return Task::where($filters)->first();
    }
}
