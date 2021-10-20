<?php

namespace App\Models\Employees;

use App\Models\Tests\Test;
use App\Models\Tests\TestQuestion;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int user_id
 * @property int test_id
 * @property int question_id
 * @property bool is_true
 */
class EmployeeTest extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'employee_test';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'test_id',
        'question_id',
        'is_true'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class)
            ->withDefault();
    }
}
