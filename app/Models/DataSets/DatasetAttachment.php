<?php

namespace App\Models\DataSets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int data_set_id
 * @property string file
 */
class DatasetAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'datasets_attachments';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = '/assets/data/media/datasets/attachments/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'data_set_id',
        'file'
    ];

    /**
     * @return BelongsTo
     */
    public function dataset(): BelongsTo
    {
        return $this->belongsTo(Dataset::class)
            ->withDefault();
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
