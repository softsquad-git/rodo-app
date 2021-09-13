<?php

namespace App\Models\Tasks;

use App\Models\Settings\Status;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int user_id
 * @property string number
 * @property string name
 * @property string description
 * @property string deadline
 * @property int progress
 * @property int status_id
 * @property User user
 * @property Status status
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static where(array $filters)
 */
class Task extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tasks';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'task';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'number',
        'name',
        'description',
        'deadline',
        'progress',
        'status_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TaskAttachment::class, 'task_id');
    }
}
