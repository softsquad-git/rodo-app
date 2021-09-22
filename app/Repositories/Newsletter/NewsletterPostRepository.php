<?php

namespace App\Repositories\Newsletter;

use App\Models\Newsletter\NewsletterPost;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsletterPostRepository
{
    /**
     * @param int $id
     * @return NewsletterPost|null
     */
    public function find(int $id): ?NewsletterPost
    {
        return NewsletterPost::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filters,
        string $orderingColumn,
        string $orderingSort,
        int    $pagination
    ): LengthAwarePaginator
    {
        $data = NewsletterPost::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['title']) && !empty($filters['title'])) {
            $data->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        return $data->paginate($pagination);
    }
}
