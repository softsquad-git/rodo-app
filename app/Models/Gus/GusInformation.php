<?php

namespace App\Models\Gus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int resource_id
 * @property string resource_type
 * @property string name
 * @property string nip
 * @property string regon
 * @property string krs
 */
class GusInformation extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'gus_information';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'resource_id',
        'resource_type',
        'name',
        'nip',
        'regon',
        'krs'
    ];
}
