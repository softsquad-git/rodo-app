<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int client_id
 * @property string number
 * @property Client client
 * @property string name
 * @property string|null release_date
 */
class ClientCertificate extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'client_certificates';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'client_id',
        'number',
        'name',
        'release_date'
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
}
