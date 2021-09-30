<?php

namespace App\Models\RCP;

use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property int count
 * @property int unit_day
 * @property int unit_month
 * @property int unit_year
 * @property int status_id
 * @property Status status
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class RCPDataRetention extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'data_retention';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'count',
        'unit_day',
        'unit_month',
        'unit_year',
        'status_id'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'data_retention';

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
