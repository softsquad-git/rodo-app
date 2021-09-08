<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string host
 * @property int port
 * @property string username
 * @property string password
 * @property string|null encryption
 * @property string|null from_address
 * @property string|null from_name
 * @method static create(array $data)
 */
class ClientSmtpConfiguration extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'client_smtp_configuration';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'client_id',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address',
        'from_name'
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
}
