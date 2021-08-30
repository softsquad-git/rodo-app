<?php

namespace App\Helpers;

use App\Models\Users\User;

class Role
{
    /**
     * @var array|string[] $role
     */
    public static array $role = [
        'ADMIN' => 'ADMIN',
        'USER' => 'USER',
        'INSPECTOR' => 'INSPECTOR'
    ];

    /**
     * @param User $user
     * @param string $role
     * @return string|array
     */
    public static function setRole(User $user, string $role): string|array
    {
        $user->update([
            'role' => $role
        ]);

        return $user->role;
    }

    /**
     * @param User $user
     * @param string|array $role
     * @return bool
     */
    public static function check(User $user, string|array $role): bool
    {
        if ($user->role == $role) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @return string|array|null
     */
    public static function get(User $user): string|array|null
    {
        return $user->role;
    }
}
