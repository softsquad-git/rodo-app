<?php

namespace App\Models\RiskAnalysis;

use App\Models\ProcessingAreas\ProcessingArea;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property string description
 * @property int status_id
 * @property Status status
 * @property string type
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
        'type',
        'status_id'
    ];

    /**
     * @var array|string[] $types
     */
    public static array $types = [
        'physical' => 'physical',                   #do obszaru
        'technical' => 'technical',                 #do zasobu
        'it' => 'it',                               #do systemów IT
        'organizational' => 'organizational',       #do firmy
        'another' => 'another'                      #widziane u każdego
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'security';

    /**
     * @return string
     */
    public function getType(): string
    {
        return __('trans.security_types.' . $this->type);
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
    public function processing_areas(): BelongsToMany
    {
        return $this->belongsToMany(
            ProcessingArea::class,
            'processing_area_security_pivot',
            'security',
            'processing_area_id');
    }
}
