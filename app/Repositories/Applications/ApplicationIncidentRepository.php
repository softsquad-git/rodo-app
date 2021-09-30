<?php

namespace App\Repositories\Applications;

use App\Models\Applications\ApplicationIncident;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationIncidentRepository
{
    /**
     * @param int $id
     * @return ApplicationIncident|null
     */
    public function find(int $id): ?ApplicationIncident
    {
        return ApplicationIncident::find($id);
    }

    /**
     * @param array $filters
     * @param string $ordering_column
     * @param string $ordering_sort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filters,
        string $ordering_column,
        string $ordering_sort,
        int    $pagination
    ): LengthAwarePaginator
    {
        $data = ApplicationIncident::orderBy($ordering_column, $ordering_sort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['type_id']) && !empty($filters['type_id'])) {
            $data->where('type_id', $filters['type_id']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        return $data->paginate($pagination);
    }
}
