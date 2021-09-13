<?php

namespace App\Models\Types;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static orderBy(string $string, string $string1)
 * @method static where(array $filters)
 * @method static create(array $data)
 * @property int id
 * @property string name
 * @property string resource_type
 */
class Type extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'types';

    /**
     * @var array|string[] $resourceTypes
     */
    public static array $resourceTypes = [
        'client' => 'client',
        'inspector' => 'inspector'
    ];

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'resource_type'
    ];

}
