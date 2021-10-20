<?php

namespace App\Models\Assets;

use App\Models\RiskAnalysis\Security;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class Resource extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'resources';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'symbol',
        'name',
        'owner',
        'description',
        'type_id',
        'status_id'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'resource';

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
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * @return BelongsToMany
     */
    public function security(): BelongsToMany
    {
        return $this->belongsToMany(
            Security::class,
            'resource_security_pivot',
            'resource_id',
            'security_id'
        );
    }
}
