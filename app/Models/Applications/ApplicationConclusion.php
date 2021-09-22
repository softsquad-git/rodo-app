<?php

namespace App\Models\Applications;

use App\Models\Employees\Employee;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property string number
 * @property string date_application
 * @property string name
 * @property string title
 * @property int type_id
 * @property int status_id
 * @property string content
 * @property int|null accepted_employee_id
 * @property bool is_accepted
 * @property string|null accepted_date
 * @property int user_id
 * @property Type type
 * @property Status status
 * @property User user
 * @property ApplicationConclusionAttachment|null attachment
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 */
class ApplicationConclusion extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'conclusions';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'date_application',
        'name',
        'title',
        'type_id',
        'status_id',
        'content',
        'accepted_employee_id',
        'is_accepted',
        'accepted_date',
        'user_id'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'conclusion';

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)
            ->where('resource_type', self::$resourceType)
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
     * @return BelongsTo
     */
    public function acceptedEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

    /**
     * @return HasOne
     */
    public function attachment(): HasOne
    {
        return $this->hasOne(ApplicationConclusionAttachment::class, 'conclusion_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault();
    }
}
