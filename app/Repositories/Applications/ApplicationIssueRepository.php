<?php

namespace App\Repositories\Applications;

use App\Models\Applications\ApplicationIssue;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationIssueRepository
{
    /**
     * @param int $id
     * @return ApplicationIssue|null
     */
    public function find(int $id): ?ApplicationIssue
    {
        return ApplicationIssue::find($id);
    }

    public function findBy(
        array  $filters,
        string $orderingColumn,
        string $orderingSort,
        int    $pagination
    ): LengthAwarePaginator
    {
        $data = ApplicationIssue::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['date_application']) && !empty($filters['date_application'])) {
            $data->where('date_application', $filters['date_application']);
        }

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        if (isset($filters['name']) && !empty($filters['name'])) {
            $data->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['title']) && !empty($filters['title'])) {
            $data->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['number_issue']) && !empty($filters['number_issue'])) {
            $data->where('number_issue', $filters['number_issue']);
        }

        if (isset($filters['status_id']) && !empty($filters['status_id'])) {
            $data->where('status_id', $filters['status_id']);
        }

        if (isset($filters['type_id']) && !empty($filters['type_id'])) {
            $data->where('type_id', $filters['type_id']);
        }

        if (isset($filters['employee_id']) && !empty($filters['employee_id'])) {
            $data->whereHas('employees', function ($e) use ($filters) {
                $e->where('employee_id', $filters['employee_id']);
            });
        }

        return $data->paginate($pagination);
    }
}
