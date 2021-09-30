<?php

namespace App\Models\Meetings;

use App\Models\Employees\Employee;
use App\Models\Settings\Status;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string number
 * @property string title
 * @property string content
 * @property int user_id
 * @property int status_id
 * @property string|null link
 * @property Status status
 * @property User user
 * @method static create(array $data)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 */
class Meeting extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'meetings';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'title',
        'content',
        'user_id',
        'status_id',
        'link'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'meeting';

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault();
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
     * @return BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            Employee::class,
            'meeting_employee_pivot',
            'meeting_id',
            'employee_id'
        );
    }
}
