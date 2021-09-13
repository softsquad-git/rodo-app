<?php

namespace App\Models\Roles;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property int user_id
 * @property bool is_access
 * @method static find(int $id)
 * @method static create(array $data)
 */
class Role extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'roles';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
    ];

}
