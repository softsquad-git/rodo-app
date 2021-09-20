<?php

namespace App\Repositories\Certificates;

use App\Models\Clients\ClientCertificate;
use Illuminate\Pagination\LengthAwarePaginator;

class CertificateRepository
{
    /**
     * @param int $id
     * @return ClientCertificate|null
     */
    public function find(int $id): ?ClientCertificate
    {
        return ClientCertificate::find($id);
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
        $data = ClientCertificate::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['client_id']) && !empty($filters['client_id'])) {
            $data->where('client_id', $filters['client_id']);
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
