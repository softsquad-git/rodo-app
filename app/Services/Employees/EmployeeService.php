<?php

namespace App\Services\Employees;

use App\Helpers\Role;
use App\Interfaces\MailInterface;
use App\Models\Employees\Employee;
use App\Models\Users\User;
use App\Traits\GenerateNumber;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeService
{
    use UploadFileTrait;
    use GenerateNumber;

    public function __construct(
        private MailInterface $mail
    )
    {

    }

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
            $data['number'] = $this->generateRandomNumber();

            if (!$data['is_contract_indefinite_period']) {
                $data['is_contract_indefinite_period'] = 0;
            } else{
                $data['end_date_contract'] = null;
            }

            /**
             * @var Employee $employee
             */
            $employee = Employee::create($data);
            if (isset($data['department_ids']) && count($data['department_ids']) > 0) {
                $employee->departments()->sync($data['department_ids']);
            }

            $this->mail
                ->setTo($user->email)
                ->setFrom(config('mail.from'))
                ->setSubject(__('_mail.subjects.welcome_employee'))
                ->setTemplate('inspector.employees.welcome')
                ->setBody([
                    'user' => $user,
                    'generatePassword' => $generatePassword
                ])
                ->send();

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
