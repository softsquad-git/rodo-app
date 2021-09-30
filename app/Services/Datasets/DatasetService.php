<?php

namespace App\Services\Datasets;

use App\Models\DataSets\Dataset;
use App\Models\DataSets\DatasetAttachment;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class DatasetService
{
    use UploadFileTrait;

    /**
     * @param array $data
     * @param Dataset|null $dataset
     * @return Dataset
     * @throws Exception
     */
    public function save(array $data, Dataset $dataset = null): Dataset
    {
        if ($dataset) {
            $dataset->update($data);

            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    $dataset->attachments()->create([
                        'dataset_id' => $dataset->id,
                        'file' => $this->uploadSingleFile($attachment, DatasetAttachment::$fileDir)
                    ]);
                }
            }

            return $dataset;
        }

        DB::beginTransaction();
        try {
            $dataset = Dataset::create($dataset);

            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    $dataset->attachments()->create([
                        'dataset_id' => $dataset->id,
                        'file' => $this->uploadSingleFile($attachment, DatasetAttachment::$fileDir)
                    ]);
                }
            }

            DB::commit();
            return $dataset;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Dataset $dataset
     * @return bool|null
     */
    public function remove(Dataset $dataset): ?bool
    {
        return $dataset->delete();
    }
}
