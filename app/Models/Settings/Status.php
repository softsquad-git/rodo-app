<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Settings
 * @property string name
 * @property int id
 * @method static find(int $id)
 * @method static where(array $filters)
 * @method static create(array $data)
 * @property string resource_type
 */
class Status extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'status';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'resource_type'
    ];

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;
}
