<?php

namespace App\Models\Applications;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int issue_id
 * @property string number
 * @property string time
 * @property int user_id
 * @property string type_document
 * @property string title
 * @property string description
 * @property string file
 * @property User user
 * @property ApplicationIssue issue
 */
class ApplicationIssueAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'issue_attachments';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'issue_id',
        'number',
        'time',
        'user_id',
        'type_document',
        'title',
        'description',
        'file'
    ];

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/issues/attachments/';

    /**
     * @return BelongsTo
     */
    public function issue(): BelongsTo
    {
        return $this->belongsTo(ApplicationIssue::class)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
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
