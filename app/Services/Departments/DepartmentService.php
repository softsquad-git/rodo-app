<?php

namespace App\Services\Departments;

use App\Models\Departments\Department;
use Illuminate\Support\Str;

class DepartmentService
{
    /**
     * @param array $data
     * @param Department|null $department
     * @return Department
     */
    public function save(array $data, Department $department = null): Department
    {
        if ($department) {

            return $department;
        }

        $data['number'] = Str::random(3);
        return Department::create($data);
    }

    /**
     * @param Department $department
     * @return bool|null
     */
    public function remove(Department $department): ?bool
    {
        return $department->delete();
    }
}
