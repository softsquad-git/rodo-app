<?php

namespace App\Repositories\Employees;

use App\Models\Employees\EmployeeCertificate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeCertificateRepository
{
    /**
     * @param int $id
     * @return EmployeeCertificate|null
     */
    public function find(int $id): ?EmployeeCertificate
    {
        return EmployeeCertificate::find($id);
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
        $data = EmployeeCertificate::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['test_id']) && !empty($filters['test_id'])) {
            $data->where('test_id', $filters['test_id']);
        }

        if (isset($filters['employee_id']) && !empty($filters['employee_id'])) {
            $data->where('employee_id', $filters['employee_id']);
        }

        if (isset($filters['certificate_pattern_id']) && !empty($filters['certificate_pattern_id'])) {
            $data->where('certificate_pattern_id', $filters['certificate_pattern_id']);
        }

        if (isset($filters['client_id']) && !empty($filters['client_id'])) {
            $data->where('client_id', $filters['client_id']);
        }

        if (isset($filters['is_all']) && $filters['is_all'] === true) {
            return $data->get();
        }

        return $data->paginate($pagination);
    }
}
