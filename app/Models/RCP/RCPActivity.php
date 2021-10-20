<?php

namespace App\Models\RCP;

use App\Models\Applications\ApplicationIncident;
use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property string basic_processing
 * @property int status_id
 * @property Status status
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 * @method static create(array $data)
 */
class RCPActivity extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'rcp_activities';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'basic_processing',
        'status_id'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'rcp_activity';

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
    public function incidents(): BelongsToMany
    {
        return $this->belongsToMany(
            ApplicationIncident::class,
            'incident_activities_pivot',
            'activity_id',
            'incident_id'
        );
    }
}
