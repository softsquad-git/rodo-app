<?php

namespace App\Services\RCP;

use App\Models\RCP\LawBasic;

class LawBasicService
{
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
