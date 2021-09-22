<?php

namespace App\Repositories\Employees;

use App\Models\Employees\Employee;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EmployeeRepository
{
    /**
     * @param int $id
     * @return Employee|null
     */
    public function find(int $id): ?Employee
    {
        return Employee::find($id);
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
        $data = Employee::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->whereHas('user', function ($user) use ($filters) {
                $user->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%" . $filters['name'] . "%");
            });
        }

        if (isset($filters['role_id']) && !empty($filters['role_id'])) {
            $data->where('role_id', $filters['role_id']);
        }

        return $data->paginate($pagination);
    }
}
