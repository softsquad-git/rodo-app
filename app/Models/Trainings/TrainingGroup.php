<?php

namespace App\Models\Trainings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

}
