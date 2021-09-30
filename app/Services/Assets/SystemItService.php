<?php

namespace App\Services\Assets;

use App\Models\Assets\SystemIt;
use Illuminate\Support\Str;

class SystemItService
{
    /**
     * @param array $data
     * @param SystemIt|null $systemIt
     * @return SystemIt
     */
    public function save(array $data, SystemIt $systemIt = null): SystemIt
    {
        if ($systemIt) {
            $systemIt->update($data);

            return $systemIt;
        }

        $data['symbol'] = Str::random(3);
        return SystemIt::create($data);
    }

    /**
     * @param SystemIt $systemIt
     * @return bool|null
     */
    public function remove(SystemIt $systemIt): ?bool
    {
        return $systemIt->delete();
    }
}
