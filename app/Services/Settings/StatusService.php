<?php

namespace App\Services\Settings;

use App\Models\Settings\Status;

class StatusService
{
    /**
     * @param array $data
     * @param Status|null $status
     * @return Status
     */
    public function save(array $data, Status $status = null): Status
    {
        if ($status) {
            $status->update($data);

            return $status;
        }

        return Status::create($data);
    }

    /**
     * @param Status $status
     * @return bool|null
     */
    public function remove(Status $status): ?bool
    {
        return $status->delete();
    }
}
