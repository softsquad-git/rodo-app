<?php

namespace App\Repositories\Employees;

use App\Models\Employees\EmployeeAuthorization;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeAuthorizationRepository
{
    /**
     * @param int $id
     * @return EmployeeAuthorization|null
     */
    public function find(int $id): ?EmployeeAuthorization
    {
        return EmployeeAuthorization::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filters = [],
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int    $pagination = 20
    ): LengthAwarePaginator
    {
        $data = EmployeeAuthorization::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['employee_id']) && !empty($filters['employee_id'])) {
            $data->where('employee_id', $filters['employee_id']);
        }

        if (isset($filters['valid_from']) && !empty($filters['valid_from'])) {
            $data->where('valid_from', '>', $filters['valid_from']);
        }

        if (isset($filters['valid_to']) && !empty($filters['valid_to'])) {
            $data->where('valid_to', $filters['valid_to']);
        }

        if (isset($filters['title']) && !empty($filters['title'])) {
            $data->where('title', 'like', '%' . $filters['title'] . '%');
        }

        return $data->paginate($pagination);
    }
}
