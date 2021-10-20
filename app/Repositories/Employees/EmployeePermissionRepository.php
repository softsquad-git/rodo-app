<?php

namespace App\Repositories\Employees;

use App\Models\Employees\EmployeePermission;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeePermissionRepository
{
    /**
     * @param int $id
     * @return EmployeePermission|null
     */
    public function find(int $id): ?EmployeePermission
    {
        return EmployeePermission::find($id);
    }

    /**
     * @param array $filter
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filter = [],
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int    $pagination = 20
    ): LengthAwarePaginator
    {
        $data = EmployeePermission::orderBy($orderingColumn, $orderingSort);

        if (isset($filter['name']) && !empty($filter['name'])) {
            $data->where('name', 'like', '%' . $filter['name'] . '%');
        }

        if (isset($filters['employee_id']) && !empty($filters['employee_id'])) {
            $data->where('employee_id', $filters['employee_id']);
        }

        if (isset($filters['valid_from']) && !empty($filters['valid_from'])) {
            $data->where('valid_from', '>', $filters['valid_from']);
        }

        if (isset($filters['valid_to']) && !empty($filters['valid_to'])) {
            $data->where('valid_to', $filters['valid_to']);
        }

        if (isset($filter['status_id']) && !empty($filter['status_id'])) {
            $data->where('status_id', $filter['status_id']);
        }

        return $data->paginate($pagination);
    }
}
