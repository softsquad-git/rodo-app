<?php

namespace App\Models\Employees;

use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int employee_id
 * @property string title
 * @property string file
 * @property int type_id
 * @property Employee employee
 * @property Type type
 */
class EmployeeAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'employee_attachments';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/employees/attachments/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'employee_id',
        'title',
        'type_id',
        'file'
    ];

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'employee_attachment';

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)
            ->where('resource_type', self::$resourceType);
    }

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        if ($this->file) {
            return asset(self::$fileDir.$this->file);
        }

        return null;
    }
}
