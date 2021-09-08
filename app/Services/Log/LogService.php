<?php

namespace App\Services\Log;

use App\Models\Log\Log;

class LogService
{
    /**
     * @param array $data
     * @return Log
     */
    public function save(array $data): Log
    {
        return Log::create($data);
    }

    /**
     * @param Log $log
     * @return bool|null
     */
    public function remove(Log $log): ?bool
    {
        return $log->delete();
    }
}
