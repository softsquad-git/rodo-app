<?php

namespace App\Models\Employees;

use App\Models\Certificates\CertificatePattern;
use App\Models\Clients\Client;
use App\Models\Tests\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int test_id
 * @property int certificate_pattern_id
 * @property int employee_id
 * @property int client_id
 * @property string|null client_name
 * @property string|null client_address
 * @property string|null employee_first_name
 * @property string|null employee_last_name
 * @property string|null employee_position
 * @property string test_date
 * @property string|null test_name
 * @property string|null test_description
 * @method static create(array $array)
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 * @property string release_date
 * @property Client client
 * @property CertificatePattern certificatePattern
 * @property Employee employee
 * @property Test test
 */
class EmployeeCertificate extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'employee_certificates';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'test_id',
        'certificate_pattern_id',
        'employee_id',
        'client_id',
        'client_name',
        'client_address',
        'client_nip',
        'employee_first_name',
        'employee_last_name',
        'employee_position',
        'test_date',
        'test_name',
        'test_description',
        'release_date'
    ];

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
    public function certificatePattern(): BelongsTo
    {
        return $this->belongsTo(CertificatePattern::class)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)
            ->withDefault();
    }
}
