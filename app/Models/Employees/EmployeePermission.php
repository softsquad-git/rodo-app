<?php

namespace App\Models\Employees;

use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int employee_id
 * @property string number
 * @property string application_number
 * @property string type
 * @property string name
 * @property string valid_from
 * @property string valid_to
 * @property int status_id
 * @property Employee employee
 * @property Status status
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class EmployeePermission extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'employee_permissions';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'employee_id',
        'number',
        'application_number',
        'type',
        'name',
        'valid_from',
        'valid_to',
        'status_id'
    ];

    /**
     * @var array|string[] $types
     */
    public static array $types = [
        'resources' => 'resources',
        'system_it' => 'system_it',
        'area' => 'area'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'employee_permission';

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
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
}
