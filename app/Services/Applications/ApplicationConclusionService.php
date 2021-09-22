<?php

namespace App\Services\Applications;

use App\Models\Applications\ApplicationConclusion;
use App\Models\Applications\ApplicationConclusionAttachment;
use App\Traits\UploadFileTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicationConclusionService
{
    use UploadFileTrait;

    /**
     * @param array $data
     * @param ApplicationConclusion|null $applicationConclusion
     * @return ApplicationConclusion
     * @throws Exception
     */
    public function save(array $data, ApplicationConclusion $applicationConclusion = null): ApplicationConclusion
    {
        if ($applicationConclusion) {
            $applicationConclusion->update($data);
            if (isset($data['file']) && !empty($data['file'])) {
                $applicationConclusion->attachment()->update([
                    'file' => $this->uploadSingleFile($data['file'], ApplicationConclusionAttachment::$fileDir)
                ]);
            }

            return $applicationConclusion;
        }

        DB::beginTransaction();
        try {
            $data['number'] = Str::random(3);
            $data['date_application'] = date('Y-m-d H:i:s');
            $applicationConclusion = ApplicationConclusion::create($data);

            if (isset($data['file']) && !empty($data['file'])) {
                ApplicationConclusionAttachment::create([
                    'conclusion_id' => $applicationConclusion->id,
                    'file' => $this->uploadSingleFile($data['file'], ApplicationConclusionAttachment::$fileDir)
                ]);
            }

            DB::commit();
            return $applicationConclusion;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param ApplicationConclusion $applicationConclusion
     * @return bool|null
     */
    public function remove(ApplicationConclusion $applicationConclusion): ?bool
    {
        return $applicationConclusion->delete();
    }
}
