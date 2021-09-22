<?php

namespace App\Models\Documents;

use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int document_id
 * @property string file
 * @property int type_id
 * @property Type type
 * @property Document document
 * @method static create(array $array)
 */
class DocumentAttachment extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'document_attachments';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'document_id',
        'file',
        'type_id'
    ];

    /**
     * @return BelongsTo
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)
            ->where('resource_type', Document::$resourceType)
            ->withDefault();
    }

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        if ($this->file) {
            return asset(Document::$fileDir . $this->file);
        }

        return null;
    }
}
