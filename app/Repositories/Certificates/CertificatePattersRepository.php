<?php

namespace App\Repositories\Certificates;

use App\Models\Certificates\CertificatePattern;
use Illuminate\Pagination\LengthAwarePaginator;

class CertificatePattersRepository
{
    /**
     * @param int $id
     * @return CertificatePattern|null
     */
    public function find(int $id): ?CertificatePattern
    {
        return CertificatePattern::find($id);
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
        $data = CertificatePattern::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', $filters['name']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        return $data->paginate($pagination);
    }
}
