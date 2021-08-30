<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Status;
use \Exception;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository
{
    /**
     * @param int $id
     * @return Status
     * @throws Exception
     */
    public function find(int $id): Status
    {
        $item = Status::find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(__('exceptions.no_exist'));
    }

    /**
     * @return Collection|array
     */
    public function findAll(): Collection|array
    {
        return Status::all();
    }

    /**
     * @param array $filters
     * @return Status|null
     */
    public function findByOne(array $filters): ?Status
    {
        return Status::where($filters)->first();
    }
}
