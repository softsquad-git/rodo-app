<?php

namespace App\Services\Applications;

use App\Models\Applications\ApplicationIncident;
use App\Models\Applications\ApplicationIncidentAttachment;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationIncidentService
{
    use UploadFileTrait;

    /**
     * @param array $data
     * @param ApplicationIncident|null $applicationIncident
     * @return ApplicationIncident
     * @throws Exception
     */
    public function save(array $data, ApplicationIncident $applicationIncident = null): ApplicationIncident
    {
        if ($applicationIncident) {

            return $applicationIncident;
        }

        DB::beginTransaction();
        try {
            if (!isset($data['user_id']) || empty($data['user_id'])) {
                $data['user_id'] = Auth::id();
            }

            /**
             * @var ApplicationIncident $item
             */
            $item = ApplicationIncident::create($data);
            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    ApplicationIncidentAttachment::create([
                        'incident_id' => $item->id,
                        'file' => $this->uploadSingleFile($attachment, ApplicationIncidentAttachment::$fileDir)
                    ]);
                }
            }

            if (isset($data['employees']) && count($data['employees']) > 0) {
                $employeeIds = [];
                foreach ($data['employees'] as $employee) {
                    $employeeIds[] = $employee['id'];
                }

                $item->employees()->sync($employeeIds);
            }

            if (isset($data['activities']) && count($data['activities']) > 0) {
                $activityIds = [];
                foreach ($data['activities'] as $activity) {
                    $activityIds[] = $activity['id'];
                }

                $item->activities()->sync($activityIds);
            }

            DB::commit();
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param ApplicationIncident $applicationIncident
     * @return bool|null
     */
    public function remove(ApplicationIncident $applicationIncident): ?bool
    {
        return $applicationIncident->delete();
    }
}
