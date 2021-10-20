<?php

namespace App\Services\Assets;

use App\Models\Assets\Resource;
use App\Traits\GenerateNumber;
use Illuminate\Support\Facades\DB;
use Exception;

class ResourceService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param Resource|null $resource
     * @return Resource
     * @throws Exception
     */
    public function save(array $data, Resource $resource = null): Resource
    {
        if ($resource) {
            $resource->update($data);
            if (isset($data['security_ids']) && count($data['security_ids']) > 0) {
                $resource->security()->sync($data['security_ids']);
            }

            return $resource;
        }

        DB::beginTransaction();
        try {
            $data['symbol'] = $this->generateRandomNumber();
            /**
             * @var Resource $resource
             */
            $resource = Resource::create($data);
            if (isset($data['security_ids']) && count($data['security_ids']) > 0) {
                $resource->security()->sync($data['security_ids']);
            }

            DB::commit();
            return $resource;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Resource $resource
     * @return bool|null
     */
    public function remove(Resource $resource): ?bool
    {
        return $resource->delete();
    }
}
