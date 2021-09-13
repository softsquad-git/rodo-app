<?php

namespace App\Observers\Trainings;

use App\Models\Trainings\Training;

class TrainingObserver
{
    public function deleted(Training $training)
    {
        $training->groups()->detach();
    }
}
