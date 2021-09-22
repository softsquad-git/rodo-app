<?php

namespace App\Models\Newsletter;

use App\Models\Clients\Client;
use App\Models\Settings\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string number
 * @property string title
 * @property string from
 * @property string to
 * @property int status_id
 * @property boolean is_all_clients
 * @property string content
 * @property Status status
 * @method static orderBy(string $orderingColumn, string $orderingSort)
 * @method static find(int $id)
 * @method static create(array $data)
 */
class NewsletterPost extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'posts_newsletter';

    /**
     * @var string $resourceType
     */
    public static string $resourceType = 'post_newsletter';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'number',
        'title',
        'from',
        'to',
        'status_id',
        'is_all_clients',
        'content'
    ];

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class)
            ->withDefault();
    }

    /**
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(
            Client::class,
            'newsletter_post_client_pivot',
            'newsletter_post_id',
            'client_id'
        );
    }
}
