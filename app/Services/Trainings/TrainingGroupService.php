<?php

namespace App\Services\Trainings;

use App\Models\Trainings\TrainingGroup;
use Illuminate\Support\Str;

class TrainingGroupService
{
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

        $data['number'] = Str::random(3);
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
}
