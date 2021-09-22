<?php

namespace App\Services\Documents;

use App\Models\Documents\Document;
use App\Models\Documents\DocumentAttachment;
use App\Traits\UploadFileTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DocumentService
{
    use UploadFileTrait;

    /**
     * @param array $data
     * @param Document|null $document
     * @return Document
     * @throws Exception
     */
    public function save(array $data, Document $document = null): Document
    {
        if ($document) {

            return $document;
        }

        DB::beginTransaction();
        try {
            if ($data['is_indefinitely']) {
                $data['is_indefinitely'] = 1;
                $data['valid_to'] = null;
            } else {
                $data['is_indefinitely'] = 0;
            }
            $data['number'] = Str::random(3);
            $data['file'] = $this->uploadSingleFile($data['file'], Document::$fileDir);
            /**
             * @var Document $document
             */
            $document = Document::create($data);
            if (isset($data['attachments']) && count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    DocumentAttachment::create([
                        'document_id' => $document->id,
                        'type_id' => $attachment['type_id'],
                        'file' => $this->uploadSingleFile($attachment['file'], Document::$fileDir)
                    ]);
                }
            }

            DB::commit();
            return $document;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Document $document
     * @return bool|null
     */
    public function remove(Document $document): ?bool
    {
        return $document->delete();
    }
}
