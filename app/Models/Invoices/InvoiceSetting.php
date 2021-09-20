<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string value
 * @method static find(int $id)
 * @method static where(array $filters)
 */
class InvoiceSetting extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'invoice_settings';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'value'
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return __('admin.invoice.settings.names.'.$this->name);
    }
}
