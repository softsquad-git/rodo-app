<?php

namespace App\Models\DataSets;

use App\Models\Categories\CategoryPeople;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property int type_id
 * @property int type_2_id
 * @property int category_people_id
 * @property string category_data
 * @property string category_data_description
 * @property string description
 * @property string purpose_processing
 * @property string data_retention_set
 * @property string data_source
 * @property string processing
 * @property string estimated_data
 * @property int status_id
 * @property Status status
 * @property Type type
 * @property Type type2
 * @property CategoryPeople categoryPeople
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(Dataset|null $dataset)
 */
class Dataset extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'datasets';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'type_id',
        'type_2_id',
        'category_people_id',
        'category_data',
        'category_data_description',
        'description',
        'purpose_processing',
        'data_retention_set',
        'data_source',
        'processing',
        'estimated_data',
        'status_id'
    ];

    /**
     * @var array|string[] $processing
     */
    public static array $processing = [
        'cyclical' => 'Cykliczne',
        'occasional' => 'Sporadyczne'
    ];

    /**
     * @var array|int[] $categoriesData
     */
    public static array $categoriesData = [
        1, 2, 3, 4
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'data_set';

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(DatasetAttachment::class, 'data_set_id');
    }

    /**
     * @return BelongsTo
     */
    public function categoryPeople(): BelongsTo
    {
        return $this->belongsTo(CategoryPeople::class)
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
     * Typ
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'id', 'type_id')
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * Rodzaj
     * @return BelongsTo
     */
    public function type2(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'id', 'type_2_id')
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }
}
