<?php

namespace App\Services\Certificates;

use App\Models\Certificates\CertificatePattern;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CertificatePattersService
{
    /**
     * @param array $data
     * @param CertificatePattern|null $certificatePattern
     * @return CertificatePattern
     * @throws Exception
     */
    public function save(array $data, CertificatePattern $certificatePattern = null): CertificatePattern
    {
        if ($certificatePattern) {

        }

        DB::beginTransaction();
        try {
            $data['number'] = Str::random(3);
            /**
             * @var CertificatePattern $certificatePattern
             */
            $certificatePattern = CertificatePattern::create($data);

            $certificatePattern->tests()->sync($data['test_ids']);

            DB::commit();
            return $certificatePattern;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param CertificatePattern $certificatePattern
     * @return bool|null
     */
    public function remove(CertificatePattern $certificatePattern): ?bool
    {
        return $certificatePattern->delete();
    }
}
