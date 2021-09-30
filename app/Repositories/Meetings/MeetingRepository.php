<?php

namespace App\Repositories\Meetings;

use App\Models\Meetings\Meeting;
use Illuminate\Pagination\LengthAwarePaginator;

class MeetingRepository
{
    /**
     * @param int $id
     * @return Meeting|null
     */
    public function find(int $id): ?Meeting
    {
        return Meeting::find($id);
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
        $data = Meeting::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        return $data->paginate($pagination);
    }
}
