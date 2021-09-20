<?php

namespace App\Observers\Trainings;

use App\Models\Trainings\TrainingGroup;

class TrainingGroupObserver
{
    public function deleted(TrainingGroup $trainingGroup)
    {
        $trainingGroup->trainings()->detach();
    }
}
