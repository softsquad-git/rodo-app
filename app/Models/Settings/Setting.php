<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Settings
 * @property int id
 * @property string name
 * @property int type
 * @property string value
 * @method static insert(array[] $data)
 * @method static find(int $id)
 * @method static truncate()
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'settings';

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'type',
        'value'
    ];

    /**
     * @var array|string[] $names
     */
    public static array $names = [
        'app_name' => 'app_name',
        'logo' => 'logo'
    ];

    /**
     * @var array|string[] $types
     */
    public static array $types = [
        'text' => 1,
        'file' => 2
    ];

    /**
     * @var string $urlDir
     */
    public static string $urlDir = 'assets/data/settings/';

    /**
     * @return string
     */
    public function getValue(): string
    {
        if ($this->type == self::$types['text']) {
            return $this->value;
        }

        return asset(self::$urlDir.$this->value);
    }
}
