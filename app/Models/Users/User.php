<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @package App\Models
 * @property string first_name
 * @property string last_name
 * @property string name
 * @property string email
 * @property string password
 * @property string avatar
 * @property string|null avatar_img
 * @property string|null role
 * @property bool is_active
 * @method static create(array $data)
 * @method static find(int $id)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string $avatarDir
     */
    protected static string $avatarDir = 'assets/data/avatars/';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar_img',
        'role',
        'is_active'
    ];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'name',
        'avatar'
    ];

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        if ($this->avatar_img) {
            return asset(self::$avatarDir.$this->avatar_img);
        }

        return asset(self::$avatarDir.'default.jpg');
    }

    /**
     * @var array $hidden
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
