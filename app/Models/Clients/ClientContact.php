<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int client_id
 * @property string|null phone
 * @property string|null email
 */
class ClientContact extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'client_contacts';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'client_id',
        'phone',
        'email'
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)
            ->withDefault();
    }
}
