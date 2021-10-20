<?php

namespace App\Models\ProcessingAreas;

use App\Models\RiskAnalysis\Security;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static find(int $id)
 * @method static create(array $data)
 */
class ProcessingArea extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'processing_areas';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'localization_id'
    ];

    /**
     * @return BelongsToMany
     */
    public function security(): BelongsToMany
    {
        return $this->belongsToMany(
            Security::class,
            'processing_area_security_pivot',
            'processing_area_id',
            'security_id'
        );
    }

}
