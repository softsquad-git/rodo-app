<?php

namespace App\Services\Tasks;

use App\Interfaces\MailInterface;
use App\Models\Tasks\Task;
use App\Models\Tasks\TaskAttachment;
use App\Traits\GenerateNumber;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskService
{
    use UploadFileTrait;
    use GenerateNumber;

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
            $data['number'] = $this->generateRandomNumber();
            $data['creator_id'] = Auth::id();
            /**
             * @var Task $task
             */
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

            $this->mail
                ->setFrom(config('mail.from'))
                ->setTo($task->user->email)
                ->setSubject(__('_mail.subjects.new_task'))
                ->setTemplate('inspector.tasks.new_task')
                ->setBody([
                    'task' => $task
                ])
                ->send();

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
