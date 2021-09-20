<?php

namespace App\Models\Certificates;

use App\Models\Settings\Status;
use App\Models\Tests\Test;
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
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $data)
 */
class CertificatePattern extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'certificates_patters';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'certificate_patter';

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
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)->withDefault();
    }

    /**
     * @return BelongsToMany
     */
    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(
            Test::class,
            'certificate_patter_test_pivot',
            'certificate_patter_id',
            'test_id'
        );
    }
}
