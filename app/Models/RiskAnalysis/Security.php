<?php

namespace App\Models\RiskAnalysis;

use App\Models\Settings\Status;
use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property string description
 * @property int type_id
 * @property int status_id
 * @property Status status
 * @property Type type
 * @method static create(array $data)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 */
class Security extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'security';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'description',
        'type_id',
        'status_id'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'security';

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
}
