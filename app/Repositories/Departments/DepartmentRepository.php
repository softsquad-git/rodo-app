<?php

namespace App\Repositories\Departments;

use App\Models\Departments\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentRepository
{
    /**
     * @param int $id
     * @return Department|null
     */
    public function find(int $id): ?Department
    {
        return Department::find($id);
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
        $data = Department::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['id']) && !empty($filters['id'])) {
            $data->where('id', $filters['id']);
        }

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $data->paginate($pagination);
    }
}
