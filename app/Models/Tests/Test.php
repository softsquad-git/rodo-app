<?php

namespace App\Models\Tests;

use App\Models\Certificates\CertificatePattern;
use App\Models\Trainings\TrainingGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string number
 * @property string name
 * @property string|null description
 * @property int number_questions
 * @property int pass_threshold
 * @property int|null group_id
 * @method static find(int $id)
 * @method static create(array $data)
 */
class Test extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tests';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'name',
        'description',
        'number_questions',
        'pass_threshold',
        'group_id'
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(TrainingGroup::class)->withDefault();
    }

    /**
     * @return BelongsToMany
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(TestQuestion::class, 'test_question_pivot', 'test_id', 'question_id');
    }

    /**
     * @return BelongsToMany
     */
    public function certificates(): BelongsToMany
    {
        return $this->belongsToMany(CertificatePattern::class, 'certificate_patter_test_pivot', 'test_id', 'certificate_patter_id');
    }
}
