<?php

namespace App\Services\Certificates;

use App\Models\Clients\ClientCertificate;
use Illuminate\Support\Facades\DB;
use Exception;

class CertificateService
{
    /**
     * @param array $filters
     * @param ClientCertificate|null $clientCertificate
     * @return ClientCertificate
     * @throws Exception
     */
    public function save(array $filters, ClientCertificate $clientCertificate = null): ClientCertificate
    {
        if ($clientCertificate) {

            return $clientCertificate;
        }

        DB::beginTransaction();
        try {

            DB::commit();
            return $clientCertificate;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param ClientCertificate $clientCertificate
     * @return bool|null
     */
    public function remove(ClientCertificate $clientCertificate): ?bool
    {
        return $clientCertificate->delete();
    }
}
