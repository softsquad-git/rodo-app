<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string[] $array)
 * @method static create(string[] $array)
 * @property int id
 * @property string token
 * @property string|null expired_at
 * @property string|null new_email
 * @property int|null user_id
 * @property User|null user
 */
class UserVerificationEmail extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_verification_email';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'email',
        'token',
        'expired_at',
        'new_email',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
