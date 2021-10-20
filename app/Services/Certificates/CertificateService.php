<?php

namespace App\Services\Certificates;

use App\Models\Employees\EmployeeCertificate;

class CertificateService
{
    /**
     * @param EmployeeCertificate $employeeCertificate
     * @return bool|null
     */
    public function remove(EmployeeCertificate $employeeCertificate): ?bool
    {
        return $employeeCertificate->delete();
    }
}
