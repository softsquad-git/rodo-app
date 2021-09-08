<?php

namespace App\Models\Clients;

use App\Models\Gus\GusInformation;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static where(array $filters)
 * @method static find(int $id)
 * @method static create(array $array)
 * @property string auto_number
 * @property string short
 * @property int type_id
 * @property int status_id
 * @property string|null address
 * @property string|null name
 * @property int gus_info_id
 * @property int smtp_config_id
 * @property bool is_archive
 * @property int id
 */
class Client extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'clients';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'client';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'auto_number',
        'short',
        'type_id',
        'status_id',
        'address',
        'name',
        'is_archive'
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id')
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id')
            ->withDefault();
    }

    /**
     * @return HasOne
     */
    public function gus(): HasOne
    {
        return $this->hasOne(GusInformation::class, 'resource_id')
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(ClientContact::class, 'client_id');
    }

    /**
     * @return HasOne
     */
    public function smtp(): HasOne
    {
        return $this->hasOne(ClientSmtpConfiguration::class, 'client_id')
            ->withDefault();
    }
}
