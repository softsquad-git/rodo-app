<?php

namespace App\Models\Applications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int incident_id
 * @property string file
 * @property ApplicationIncident incident
 * @method static create(array $array)
 */
class ApplicationIncidentAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'incidents_attachments';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/incidents/attachments/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'incident_id',
        'file'
    ];

    /**
     * @return BelongsTo
     */
    public function incident(): BelongsTo
    {
        return $this->belongsTo(ApplicationIncident::class)->withDefault();
    }

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        if ($this->file) {
            return asset(self::$fileDir . $this->file);
        }

        return null;
    }
}
