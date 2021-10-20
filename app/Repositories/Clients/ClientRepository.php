<?php

namespace App\Repositories\Clients;

use App\Models\Clients\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository
{
    /**
     * @param int $id
     * @return Client|null
     */
    public function find(int $id): ?Client
    {
        return Client::find($id);
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
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int $pagination = 20
    ): LengthAwarePaginator
    {
        $data = Client::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['is_archive'])) {
            $data->where('is_archive', $filters['is_archive']);
        }

        if (isset($filters['inspector_id']) && !empty($filters['inspector_id'])) {
            $data->where('inspector_id', $filters['inspector_id']);
        }

        return $data->paginate($pagination);
    }

    /**
     * @param array $filters
     * @return Client|null
     */
    public function findByOne(array $filters): ?Client
    {
        return Client::where($filters)->first();
    }

    public function findAll()
    {
        return Client::all();
    }
}
