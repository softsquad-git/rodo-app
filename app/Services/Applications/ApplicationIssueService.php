<?php

namespace App\Services\Applications;

use App\Models\Applications\ApplicationIssue;
use App\Traits\GenerateNumber;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationIssueService
{
    use UploadFileTrait;
    use GenerateNumber;

    /**
     * @param array $data
     * @param ApplicationIssue|null $applicationIssue
     * @return ApplicationIssue
     * @throws Exception
     */
    public function save(array $data, ApplicationIssue $applicationIssue = null): ApplicationIssue
    {
        if ($applicationIssue) {
            if (isset($data['file']) && !empty($data['file'])) {
                $data['file'] = $this->uploadSingleFile($data['file'], ApplicationIssue::$fileDir);
            }

            $applicationIssue->update($data);

            return $applicationIssue;
        }

        DB::beginTransaction();
        try {
            if (isset($data['file']) && !empty($data['file'])) {
                $data['file'] = $this->uploadSingleFile($data['file'], ApplicationIssue::$fileDir);
            }

            $data['number'] = $this->generateRandomNumber();
            $data['user_id'] = Auth::id();
            /**
             * @var ApplicationIssue $applicationIssue
             */
            $applicationIssue = ApplicationIssue::create($data);
            $employeeIds = [];
            foreach ($data['employees'] as $employee) {
                $employeeIds[] = $employee['id'];
            }
            $applicationIssue->employees()->sync($employeeIds);

            DB::commit();
            return $applicationIssue;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param ApplicationIssue $applicationIssue
     * @return bool|null
     */
    public function remove(ApplicationIssue $applicationIssue): ?bool
    {
        return $applicationIssue->delete();
    }
}
