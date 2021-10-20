<?php

namespace App\Services\Employees;

use App\Models\Employees\EmployeeAuthorization;
use App\Traits\GenerateNumber;
use Illuminate\Support\Str;

class EmployeeAuthorizationService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param EmployeeAuthorization|null $employeeAuthorization
     * @return EmployeeAuthorization|null
     */
    public function save(array $data, EmployeeAuthorization $employeeAuthorization = null): ?EmployeeAuthorization
    {
        if ($employeeAuthorization) {
            $employeeAuthorization->update($data);

            return $employeeAuthorization;
        }

        $data['number'] = $this->generateRandomNumber();
        return EmployeeAuthorization::create($data);
    }

    /**
     * @param EmployeeAuthorization $employeeAuthorization
     * @return bool|null
     */
    public function remove(EmployeeAuthorization $employeeAuthorization): ?bool
    {
        return $employeeAuthorization->delete();
    }
}
