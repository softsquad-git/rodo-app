<?php

namespace App\Services\Employees;

use App\Models\Employees\EmployeeCertificate;

class EmployeeCertificateService
{
    /**
     * @param EmployeeCertificate $employeeCertificate
     * @return string
     */
    public function generateFileData(EmployeeCertificate $employeeCertificate): string
    {
        $description = $employeeCertificate->certificatePattern->description;

        $description = str_replace("[EMPLOYEE_FIRST_NAME]", 'Michał', $description);
        $description = str_replace("[EMPLOYEE_LAST_NAME]", 'Łosak', $description);
        $description = str_replace("[CLIENT_NAME]", $employeeCertificate->client->name, $description);
        $description = str_replace("[CLIENT_NIP]", $employeeCertificate->client->name, $description);
        $description = str_replace("[CLIENT_ADDRESS]", $employeeCertificate->client->name, $description);
        $description = str_replace("[CLIENT_POSITION]", $employeeCertificate->client->name, $description);
        $description = str_replace("[TEST_DATE]", $employeeCertificate->client->name, $description);
        $description = str_replace("[TEST_NAME]", $employeeCertificate->test->name, $description);
        $description = str_replace("[EMPLOYEE_POSITION]", $employeeCertificate->test->name, $description);
        return str_replace("[TEST_DESCRIPTION]", $employeeCertificate->test->description, $description);
    }
}
