<?php

namespace App\Models\Tests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int question_id
 * @property string name
 * @property boolean is_true
 * @method static create(array $array)
 * @method static whereIn(string $string, array $answersIds)
 */
class TestQuestionAnswer extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'test_question_answers';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'test_question_id',
        'name',
        'is_true'
    ];

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class)->withDefault();
    }
}
