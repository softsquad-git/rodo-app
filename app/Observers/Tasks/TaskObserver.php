<?php

namespace App\Observers\Tasks;

use App\Models\Tasks\Task;

class TaskObserver
{
    public function deleted(Task $task)
    {
        $task->attachments()->delete();
    }
}
