<?php

namespace App\Repositories\Users;
use App\Models\Users\User;

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
}
