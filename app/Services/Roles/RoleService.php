<?php

namespace App\Services\Roles;

use App\Models\Roles\Role;

class RoleService
{
    /**
     * @param array $data
     * @param Role|null $role
     * @return Role
     */
    public function save(array $data, Role $role = null): Role
    {
        if ($role) {
            $role->update($data);

            return $role;
        }

        return Role::create($data);
    }

    /**
     * @param Role $role
     * @return bool|null
     */
    public function remove(Role $role): ?bool
    {
        return $role->delete();
    }
}
