<?php

namespace App\Repositories\Users;
use App\Models\Users\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @param bool $isAll
     * @return LengthAwarePaginator|Collection|array
     */
    public function findBy(
        array $filters,
        string $ordering = 'DESC',
        int $pagination = 20,
        bool $isAll = false
    ): LengthAwarePaginator|Collection|array
    {
        $data = User::orderBy('id', $ordering);

        if (isset($filters['email']) && !empty($filters['email'])) {
            $data->where('email', $filters['email']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%" . $filters['name'] . "%");
        }

        if (isset($filters['role']) && !empty($filters['role'])) {
            $data->where('role', $filters['role']);
        }

        if (isset($filters['is_active']) && !empty($filters['is_active'])) {
            $data->where('is_active', $filters['is_active']);
        }

        if ($isAll === true) {
            return $data->get();
        }

        return $data->paginate($pagination);
    }
}
