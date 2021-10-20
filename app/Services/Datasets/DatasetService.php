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

            $this->syncRelationshipDataset($data, $dataset);

            return $dataset;
        }

        DB::beginTransaction();
        try {
            /**
             * @var Dataset $dataset
             */
            $dataset = Dataset::create($dataset);

            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    $dataset->attachments()->create([
                        'dataset_id' => $dataset->id,
                        'file' => $this->uploadSingleFile($attachment, DatasetAttachment::$fileDir)
                    ]);
                }
            }

            $this->syncRelationshipDataset($data, $dataset);

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

    /**
     * @param array $data
     * @param Dataset $dataset
     */
    private function syncRelationshipDataset(array $data, Dataset $dataset)
    {
        if (isset($data['processing_areas']) && count($data['processing_areas']) > 0) {
            $dataset->processingAreas()->sync($data['processing_areas']);
        }

        if (isset($data['it_systems']) && count($data['it_systems'])) {
            $dataset->itSystems()->sync($data['it_systems']);
        }

        if (isset($data['resources']) && count($data['resources']) > 0) {
            $dataset->resources()->sync($data['resources']);
        }

        if (isset($data['basic_law']) && count($data['basic_law']) > 0) {
            $dataset->basicLaw()->sync($data['basic_law']);
        }
    }
}
