<?php

namespace App\Services\RiskAnalysis;

use App\Models\RiskAnalysis\Security;
use App\Traits\GenerateNumber;

class SecurityService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param Security|null $security
     * @return Security
     */
    public function save(array $data, Security $security = null): Security
    {
        if ($security) {
            $security->update($data);

            return $security;
        }

        $data['number'] = $this->generateRandomNumber();
        return Security::create($data);
    }

    /**
     * @param Security $security
     * @return bool|null
     */
    public function remove(Security $security): ?bool
    {
        return $security->delete();
    }
}
