<?php

namespace App\Repositories\Documents;

use App\Models\Documents\Document;
use Illuminate\Pagination\LengthAwarePaginator;

class DocumentRepository
{
    /**
     * @param int $id
     * @return Document|null
     */
    public function find(int $id): ?Document
    {
        return Document::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array  $filters = [],
        string $orderingColumn = 'id',
        string $orderingSort = 'DESC',
        int    $pagination = 20
    ): LengthAwarePaginator
    {
        $data = Document::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['type_id']) && !empty($filters['type_id'])) {
            $data->where('type_id', $filters['type_id']);
        }

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->whereHas('departments', function ($department) use ($filters) {
                $department->whereHas('employees', function ($employee) use ($filters) {
                    $employee->whereHas('user', function ($user) use ($filters) {
                        $user->where('id', $filters['user_id']);
                    });
                });
            });
        }

        return $data->paginate($pagination);
    }
}
