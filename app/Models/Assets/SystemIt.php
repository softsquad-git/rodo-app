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
 * @property int id
 * @property string symbol
 * @property string name
 * @property string owner
 * @property string description
 * @property int type_id
 * @property int status_id
 * @property Status status
 * @property Type type
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class SystemIt extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'it_systems';

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
    public static string $resourceType = 'system_it';

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

    /**
     * @return BelongsToMany
     */
    public function security(): BelongsToMany
    {
        return $this->belongsToMany(
            Security::class,
            'it_system_security_pivot',
            'it_system_id',
            'security_id'
        );
    }
}
