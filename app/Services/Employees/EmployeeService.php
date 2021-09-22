<?php

namespace App\Services\Employees;

use App\Helpers\Role;
use App\Models\Employees\Employee;
use App\Models\Users\User;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeService
{
    use UploadFileTrait;

    /**
     * @param array $data
     * @param Employee|null $employee
     * @return Employee
     * @throws Exception
     */
    public function save(array $data, Employee $employee = null): Employee
    {
        if ($employee) {

            return $employee;
        }

        DB::beginTransaction();
        try {
            $generatePassword = Str::random(8);
            $data['password'] = Hash::make($generatePassword);
            $data['role'] = Role::$role['EMPLOYEE'];
            /**
             * @var User $user
             */
            $user = User::create($data);

            $data['user_id'] = $user->id;
            $data['number'] = Str::random(3);

            if (!$data['is_contract_indefinite_period']) {
                $data['is_contract_indefinite_period'] = 0;
            } else{
                $data['end_date_contract'] = null;
            }

            /**
             * @var Employee $employee
             */
            $employee = Employee::create($data);
            $employee->departments()->sync($data['department_ids']);

            DB::commit();
            return $employee;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Employee $employee
     * @return bool|null
     */
    public function remove(Employee $employee): ?bool
    {
        return $employee->delete();
    }
}
