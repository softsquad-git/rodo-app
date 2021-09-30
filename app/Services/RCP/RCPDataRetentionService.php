<?php

namespace App\Services\RCP;

use App\Models\RCP\RCPDataRetention;

class RCPDataRetentionService
{
    /**
     * @param array $data
     * @param RCPDataRetention|null $RCPDataRetention
     * @return RCPDataRetention
     */
    public function save(array $data, RCPDataRetention $RCPDataRetention = null): RCPDataRetention
    {
        if ($RCPDataRetention) {
            $RCPDataRetention->update($data);

            return $RCPDataRetention;
        }

        return RCPDataRetention::create($data);
    }

    /**
     * @param RCPDataRetention $RCPDataRetention
     * @return bool|null
     */
    public function remove(RCPDataRetention $RCPDataRetention): ?bool
    {
        return $RCPDataRetention->delete();
    }
}
