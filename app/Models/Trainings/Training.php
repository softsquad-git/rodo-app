<?php

namespace App\Models\Trainings;

use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property string number
 * @property int status_id
 * @property string file
 * @property Status status
 * @method static find(int $id)
 * @method static where(array $filters)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class Training extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'trainings';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'training';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/trainings/materials/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'description',
        'number',
        'status_id',
        'file'
    ];

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
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(TrainingGroup::class, 'trainings_groups_pivot', 'training_id', 'group_id');
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return asset(self::$fileDir.$this->file);
    }
}
