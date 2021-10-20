<?php

namespace App\Observers\Assets;

use App\Models\Assets\SystemIt;

class SystemItObserver
{
    /**
     * @param SystemIt $systemIt
     */
    public function deleted(SystemIt $systemIt)
    {
        $systemIt->security()->detach();
    }
}
