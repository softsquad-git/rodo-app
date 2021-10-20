<?php

namespace App\Models\Trainings;

use App\Models\Departments\Department;
use App\Models\Tests\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string number
 * @property string name
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 */
class TrainingGroup extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'training_groups';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function trainings(): BelongsToMany
    {
        return $this->belongsToMany(
            Training::class,
            'trainings_groups_pivot',
            'group_id',
            'training_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(
            Department::class,
            'training_group_department_pivot',
            'training_group_id',
            'department_id'
        );
    }

    /**
     * @return HasMany
     */
    public function tests(): HasMany
    {
        return $this->hasMany(
            Test::class,
            'group_id'
        );
    }
}
