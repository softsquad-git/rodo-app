<?php

namespace App\Models\Applications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int conclusion_id
 * @property string file
 * @property ApplicationConclusion conclusion
 * @method static create(array $array)
 */
class ApplicationConclusionAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'conclusion_attachments';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'conclusion_id',
        'file'
    ];

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/applications/conclusion/attachments/';

    /**
     * @return BelongsTo
     */
    public function conclusion(): BelongsTo
    {
        return $this->belongsTo(ApplicationConclusion::class)->withDefault();
    }

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        if ($this->file) {
            return asset(self::$fileDir.$this->file);
        }

        return null;
    }
}
