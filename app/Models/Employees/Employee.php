<?php

namespace App\Models\Employees;

use App\Models\Clients\Client;
use App\Models\Departments\Department;
use App\Models\Roles\Role;
use App\Models\Types\Type;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int user_id
 * @property string number
 * @property string|null hr_id
 * @property string|null it_id
 * @property int client_id
 * @property string|null position
 * @property int role_id
 * @property int type_contract_id
 * @property string end_date_contract
 * @property bool|null is_contract_indefinite_period
 * @property string|null comments
 * @property User user
 * @property Role role
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class Employee extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'employees';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'employee';

    /**
     * @var string $resourceTypeContract
     */
    public static string $resourceTypeContract = 'contract';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'number',
        'hr_id',
        'it_id',
        'client_id',
        'position',
        'role_id',
        'type_contract_id',
        'end_date_contract',
        'is_contract_indefinite_period',
        'comments'
    ];

    /**
     * @return BelongsToMany
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(
            Department::class,
            'employee_department_pivot',
            'employee_id',
            'department_id'
        );
    }

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
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(EmployeeAttachment::class, 'employee_id');
    }

    /**
     * @return BelongsTo
     */
    public function type_contract(): BelongsTo
    {
        return $this->belongsTo(Type::class)
            ->where('resource_type', self::$resourceTypeContract)
            ->withDefault();
    }
}
