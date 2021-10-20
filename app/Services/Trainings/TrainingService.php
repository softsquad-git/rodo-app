<?php

namespace App\Services\Trainings;

use App\Models\Trainings\Training;
use App\Traits\GenerateNumber;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class TrainingService
{
    use UploadFileTrait;
    use GenerateNumber;

    /**
     * @param array $data
     * @param Training|null $training
     * @return Training
     * @throws Exception
     */
    public function save(array $data, Training $training = null): Training
    {
        if ($training) {

        }

        DB::beginTransaction();
        try {
            $data['file'] = $this->uploadSingleFile($data['file'], Training::$fileDir);
            $data['number'] = $this->generateRandomNumber();
            /**
             * @var Training $training
             */
            $data['status_id'] = 1;
            $training = Training::create($data);
            $training->groups()->sync($data['groups']);

            DB::commit();
            return $training;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Training $training
     * @return bool|null
     */
    public function remove(Training $training): ?bool
    {
        return $training->delete();
    }
}
