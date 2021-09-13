<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int task_id
 * @property string file
 * @method static create(array $array)
 */
class TaskAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'task_attachments';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/tasks/attachments/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'task_id',
        'file'
    ];

    /**
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class)->withDefault();
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        if ($this->file) {
            return asset(self::$fileDir.$this->file);
        }

        return '';
    }
}
