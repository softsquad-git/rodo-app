<?php

namespace App\Models\Documents;

use App\Models\Departments\Department;
use App\Models\Settings\Status;
use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string number
 * @property int type_id
 * @property string description
 * @property string name
 * @property string valid_from
 * @property string valid_to
 * @property bool is_indefinitely
 * @property bool is_required_confirmation
 * @property int status_id
 * @property string file
 * @property Type type
 * @property Status status
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 */
class Document extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'documents';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'document';

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/media/documents/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'type_id',
        'description',
        'name',
        'valid_from',
        'valid_to',
        'is_indefinitely',
        'is_required_confirmation',
        'status_id',
        'file'
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)
            ->where('resource_type', self::$resourceType)
            ->withDefault();
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(DocumentAttachment::class, 'document_id');
    }

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        if ($this->file) {
            return asset(self::$fileDir . $this->file);
        }

        return null;
    }

    /**
     * @return BelongsToMany
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(
            Department::class,
            'document_department_pivot',
            'document_id',
            'department_id'
        );
    }
}
