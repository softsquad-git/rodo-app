<?php

namespace App\Models\Tests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static create(array $array)
 * @property int id
 * @property string name
 */
class TestQuestion extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'test_questions';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(
            TestQuestionAnswer::class,
            'test_question_id'
        );
    }
}
