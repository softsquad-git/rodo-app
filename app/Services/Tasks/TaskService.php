<?php

namespace App\Services\Tasks;

use App\Interfaces\MailInterface;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskAttachment;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskService
{
    use UploadFileTrait;

    public function __construct(
        private MailInterface $mail
    )
    {
    }

    /**
     * @param array $data
     * @param Task|null $task
     * @return Task
     * @throws Exception
     */
    public function save(array $data, Task $task = null): Task
    {
        if ($task) {
            $task->update($data);
            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    $file = $this->uploadSingleFile($attachment, TaskAttachment::$fileDir);
                    TaskAttachment::create([
                        'task_id' => $task->id,
                        'file' => $file
                    ]);
                }
            }

            return $task;
        }

        DB::beginTransaction();
        try {
            $data['number'] = Str::random(4);
            $task = Task::create($data);
            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    $file = $this->uploadSingleFile($attachment, TaskAttachment::$fileDir);
                    TaskAttachment::create([
                        'task_id' => $task->id,
                        'file' => $file
                    ]);
                }
            }

            DB::commit();
            return $task;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Task $task
     * @return bool|null
     */
    public function remove(Task $task): ?bool
    {
        return $task->delete();
    }
}
