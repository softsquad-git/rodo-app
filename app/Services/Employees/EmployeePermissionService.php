<?php

namespace App\Services\Employees;

use App\Models\Employees\EmployeePermission;
use App\Traits\GenerateNumber;
use Illuminate\Support\Str;

class EmployeePermissionService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param EmployeePermission|null $employeePermission
     * @return EmployeePermission
     */
    public function save(array $data, EmployeePermission $employeePermission = null): EmployeePermission
    {
        if ($employeePermission) {
            $employeePermission->update($data);

            return $employeePermission;
        }

        $data['number'] = $this->generateRandomNumber();
        return EmployeePermission::create($data);
    }

    /**
     * @param EmployeePermission $employeePermission
     * @return bool|null
     */
    public function remove(EmployeePermission $employeePermission): ?bool
    {
        return $employeePermission->delete();
    }
}
