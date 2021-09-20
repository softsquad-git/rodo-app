<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string number
 * @property string date_issue
 * @property string client_name
 * @property string nip
 * @property string payment_date
 * @property string amount
 * @property int|null days_after_deadline
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 */
class Invoice extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'invoices';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'date_issue',
        'client_name',
        'nip',
        'payment_date',
        'amount',
        'days_after_deadline'
    ];
}
