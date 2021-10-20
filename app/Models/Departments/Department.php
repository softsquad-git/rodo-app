<?php

namespace App\Models\Departments;

use App\Models\Employees\Employee;
use App\Models\Settings\Status;
use App\Models\Tests\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property int status_id
 * @property Status status
 * @method static create(array $data)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 */
class Department extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'departments';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'department';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'status_id'
    ];

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)
            ->where('resource_type', self::$resourceType);
    }

    /**
     * @return BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(
            Employee::class,
            'employee_department_pivot',
            'department_id',
            'employee_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(
            Test::class,
            'test_department_pivot',
            'department_id',
            'test_id'
        );
    }
}
