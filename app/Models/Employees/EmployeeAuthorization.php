<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int employee_id
 * @property string number
 * @property string title
 * @property string valid_from
 * @property string valid_to
 * @property Employee employee
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 * @method static create(array $data)
 */
class EmployeeAuthorization extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'employee_authorizations';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'title',
        'valid_from',
        'valid_to',
        'employee_id'
    ];

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->withDefault();
    }
}
