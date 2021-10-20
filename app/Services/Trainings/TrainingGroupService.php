<?php

namespace App\Services\Trainings;

use App\Models\Trainings\TrainingGroup;
use App\Traits\GenerateNumber;

class TrainingGroupService
{
    use GenerateNumber;

    /**
     * @param array $data
     * @param TrainingGroup|null $trainingGroup
     * @return TrainingGroup
     */
    public function save(array $data, TrainingGroup $trainingGroup = null): TrainingGroup
    {
        if ($trainingGroup) {
            $trainingGroup->update($data);

            return $trainingGroup;
        }

        $data['number'] = $this->generateRandomNumber();
        return TrainingGroup::create($data);
    }

    /**
     * @param TrainingGroup $trainingGroup
     * @return bool|null
     */
    public function remove(TrainingGroup $trainingGroup): ?bool
    {
        return $trainingGroup->delete();
    }

    /**
     * @param array $departmentIds
     * @param TrainingGroup $trainingGroup
     * @return TrainingGroup
     */
    public function assignGroupDepartment(array $departmentIds, TrainingGroup $trainingGroup): TrainingGroup
    {
        $trainingGroup->departments()->sync($departmentIds);

        return $trainingGroup;
    }
}
