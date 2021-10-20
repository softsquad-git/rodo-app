<?php

namespace App\Observers\Assets;

use App\Models\Assets\Resource;

class ResourceObserver
{
    /**
     * @param Resource $resource
     */
    public function deleted(Resource $resource)
    {
        $resource->security()->detach();
    }
}
