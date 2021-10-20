<?php

namespace App\Models\Applications;

use App\Models\Employees\Employee;
use App\Models\RCP\RCPActivity;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string number
 * @property string date_application
 * @property string|null date_receipt_company
 * @property int user_id
 * @property string type_author
 * @property string title
 * @property string author_name
 * @property string|null content
 * @property int type_id
 * @property int status_id
 * @property User user
 * @property Status status
 * @property Type type
 * @method static orderBy(string $ordering_column, string $ordering_sort)
 * @method static find(int $id)
 * @method static create(array $data)
 */
class ApplicationIncident extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'incidents';

    /**
     * @var array|string[] $typesAuthor
     */
    public static array $typesAuthor = [
        'employee' => 'employee',
        'subcontractor' => 'subcontractor',
        'media' => 'media',
        'business_partner' => 'business_partner',
        'third_party' => 'third_party'
    ];

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'number',
        'date_application',
        'date_receipt_company',
        'user_id',
        'type_author',
        'author_name',
        'title',
        'content',
        'type_id',
        'status_id',
        'date_writing'
    ];

    /** @var string $resourceType */
    public static string $resourceType = 'incident';

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
     * @return string
     */
    public function getTypeAuthorAttribute(): string
    {
        return __('trans.type_authors.' . $this->type_author);
    }

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'typeAuthor'
    ];

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(ApplicationIncidentAttachment::class, 'incident_id');
    }

    /**
     * @return BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(
            Employee::class,
            'incident_employees_pivot',
            'incident_id',
            'employee_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(
            RCPActivity::class,
            'incident_activities_pivot',
            'incident_id',
            'activity_id'
        );
    }
}
