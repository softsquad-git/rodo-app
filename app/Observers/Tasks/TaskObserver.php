<?php

namespace App\Observers\Tasks;

use App\Models\Tasks\Task;
use App\Models\Tasks\TaskAttachment;
use App\Traits\UploadFileTrait;
use Exception;

class TaskObserver
{
    use UploadFileTrait;

    /**
     * @param Task $task
     * @throws Exception
     */
    public function deleted(Task $task)
    {
        foreach ($task->attachments() as $attachment) {
            $this->removeSingleFile($attachment, TaskAttachment::$fileDir);
        }

        $task->attachments()->delete();
    }
}
