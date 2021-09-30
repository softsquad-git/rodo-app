<?php

namespace App\Services\Meetings;

use App\Helpers\Select;
use App\Models\Meetings\Meeting;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MeetingService
{
    /**
     * @param array $data
     * @param Meeting|null $meeting
     * @return Meeting
     * @throws Exception
     */
    public function save(array $data, Meeting $meeting = null): Meeting
    {
        if ($meeting) {
            $meeting->update($data);

            if (isset($data['participants']) && count($data['participants']) > 0) {
                $meeting->participants()->sync($data['participants']);
            }

            return $meeting;
        }

        DB::beginTransaction();
        try {
            $data['number'] = Str::random(3);
            $data['user_id'] = Auth::id();
            /**
             * @var Meeting $meeting
             */
            $meeting = Meeting::create($data);

            $data['participants'] = Select::getIdsFromArray($data['participants']);
            if (isset($data['participants']) && count($data['participants']) > 0) {
                $meeting->participants()->sync($data['participants']);
            }

            DB::commit();
            return $meeting;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Meeting $meeting
     * @return bool|null
     */
    public function remove(Meeting $meeting): ?bool
    {
        return $meeting->delete();
    }
}
