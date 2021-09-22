<?php

namespace App\Services\Applications;

use App\Models\Applications\ApplicationIssue;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class ApplicationIssueService
{
    use UploadFileTrait;

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

            DB::commit();
            return ApplicationIssue::create($data);
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
