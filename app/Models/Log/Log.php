<?php

namespace App\Models\Log;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int user_id
 * @property string action
 * @property int|null resource_id
 * @property string|null resource_type
 * @property int id
 * @property string ip_address
 * @method static orderBy(string $string, string $ordering)
 * @method static find(int $id)
 * @method static create(array $array)
 */
class Log extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'logs';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'action',
        'resource_type',
        'resource_id',
        'ip_address'
    ];

    /**
     * @var array|string[] $actions
     */
    public static array $actions = [
        'login' => 'login',
        'register' => 'register',
        'logout' => 'logout',
        'activate_account' => 'activate_account',
        'deleted' => 'deleted',
        'created' => 'created',
        'updated' => 'updated'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
