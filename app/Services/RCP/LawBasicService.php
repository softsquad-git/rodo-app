<?php

namespace App\Services\RCP;

use App\Models\RCP\LawBasic;
use App\Traits\GenerateNumber;

class LawBasicService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param LawBasic|null $lawBasic
     * @return LawBasic
     */
    public function save(array $data, LawBasic $lawBasic = null): LawBasic
    {
        if ($lawBasic) {
            $lawBasic->update($data);

            return $lawBasic;
        }

        $data['number'] = $this->generateRandomNumber();
        return LawBasic::create($data);
    }

    /**
     * @param LawBasic $lawBasic
     * @return bool|null
     */
    public function remove(LawBasic $lawBasic): ?bool
    {
        return $lawBasic->delete();
    }
}
