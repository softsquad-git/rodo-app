<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleRepository
{
    /**
     * @param int $id
     * @return Role|null
     */
    public function find(int $id): ?Role
    {
        return Role::find($id);
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
        $data = Role::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $data->paginate($pagination);
    }
}
