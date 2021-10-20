<?php

namespace App\Models\Applications;

use App\Models\Employees\Employee;
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
 * @property string date_show_writing
 * @property string date_receipt_company
 * @property int user_id
 * @property string name
 * @property string title
 * @property string number_issue
 * @property int status_id
 * @property int type_id
 * @property string content
 * @property string file
 * @property User user
 * @property Type type
 * @property Status status
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 * @method static create(array $data)
 */
class ApplicationIssue extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'issues';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'date_application',
        'date_show_writing',
        'date_receipt_company',
        'user_id',
        'name',
        'title',
        'number_issue',
        'status_id',
        'type_id',
        'content',
        'file'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'issue';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/issues/';

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
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(ApplicationIssueAttachment::class, 'issue_id');
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

    /**
     * @return BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(
            Employee::class,
            'issue_employees_pivot',
            'issue_id',
            'employee_id'
        );
    }
}
