<?php

namespace App\Services\ProcessingAreas;

use App\Models\ProcessingAreas\ProcessingArea;
use App\Traits\GenerateNumber;
use Illuminate\Support\Facades\DB;
use Exception;

class ProcessingAreaService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param ProcessingArea|null $processingArea
     * @return ProcessingArea
     * @throws Exception
     */
    public function save(array $data, ProcessingArea $processingArea = null): ProcessingArea
    {
        if ($processingArea) {

            return $processingArea;
        }

        DB::commit();
        try {
            $data['number'] = $this->generateRandomNumber();
            /**
             * @var ProcessingArea $processingArea
             */
            $processingArea = ProcessingArea::create($data);
            $processingArea->security()->sync($data['security_ids']);

            DB::commit();
            return $processingArea;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param ProcessingArea $processingArea
     * @return bool|null
     */
    public function remove(ProcessingArea $processingArea): ?bool
    {
        return $processingArea->delete();
    }
}
