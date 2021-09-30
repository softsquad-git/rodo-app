<?php

namespace App\Services\RCP;

use App\Models\RCP\RCPActivity;

class RCPActivityService
{
    /**
     * @param array $data
     * @param RCPActivity|null $RCPActivity
     * @return RCPActivity
     */
    public function save(array $data, RCPActivity $RCPActivity = null): RCPActivity
    {
        if ($RCPActivity) {
            $RCPActivity->update($data);

            return $RCPActivity;
        }

        return RCPActivity::create($data);
    }

    /**
     * @param RCPActivity $RCPActivity
     * @return bool|null
     */
    public function remove(RCPActivity $RCPActivity): ?bool
    {
        return $RCPActivity->delete();
    }
}
