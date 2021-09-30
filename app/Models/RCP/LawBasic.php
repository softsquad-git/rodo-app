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
 * @property string description
 * @property int status_id
 * @property Status status
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 * @method static create(array $data)
 */
class LawBasic extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'law_basics';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'description',
        'status_id'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'law_basic';

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
