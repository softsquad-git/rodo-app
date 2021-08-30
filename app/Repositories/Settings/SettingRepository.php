<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Setting;
use \Exception;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository
{
    /**
     * @param int $id
     * @return Setting
     * @throws Exception
     */
    public function find(int $id): Setting
    {
        $item = Setting::find($id);
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
        return Setting::all();
    }
}
