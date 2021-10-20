<?php

namespace App\Services\Assets;

use App\Models\Assets\SystemIt;
use App\Traits\GenerateNumber;
use Illuminate\Support\Facades\DB;
use Exception;

class SystemItService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param SystemIt|null $systemIt
     * @return SystemIt
     * @throws Exception
     */
    public function save(array $data, SystemIt $systemIt = null): SystemIt
    {
        if ($systemIt) {
            $systemIt->update($data);
            if (isset($data['security_ids']) && count($data['security_ids']) > 0) {
                $systemIt->security()->sync($data['security_ids']);
            }

            return $systemIt;
        }

        $data['symbol'] = $this->generateRandomNumber();
        DB::beginTransaction();
        try {
            /**
             * @var SystemIt $systemIt
             */
            $systemIt = SystemIt::create($data);
            if (isset($data['security_ids']) && count($data['security_ids']) > 0) {
                $systemIt->security()->sync($data['security_ids']);
            }

            DB::commit();
            return $systemIt;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
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
