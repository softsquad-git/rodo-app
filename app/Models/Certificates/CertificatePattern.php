<?php

namespace App\Models\Certificates;

use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property string description
 * @property int status_id
 * @property Status status
 */
class CertificatePattern extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'certificates_patters';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'description',
        'status_id'
    ];

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)->withDefault();
    }
}
