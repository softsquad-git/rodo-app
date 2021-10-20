<?php

namespace App\Services\Clients;

use App\Models\Clients\Client;
use App\Traits\GenerateNumber;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientService
{
    use GenerateNumber;

    public function __construct(
        private ClientSmtpConfigurationService $clientSmtpConfigurationService
    )
    {
    }

    /**
     * @param array $data
     * @param Client|null $client
     * @return Client
     * @throws Exception
     */
    public function save(array $data, Client $client = null): Client
    {
        if ($client) {
            //
        }

        DB::beginTransaction();
        try {
            $clientData = $data['data'];
            $clientData['auto_number'] = $this->generateRandomNumber();
            /**
             * @var Client $client
             */
            $client = Client::create($clientData);

            $clientData['resource_id'] = $client->id;
            $clientData['resource_type'] = Client::$resourceType;
            $client->gus()->create($clientData);

            $data['smtp']['client_id'] = $client->id;
            $this->clientSmtpConfigurationService->create($data['smtp']);

            $contactData = $data['contact'];
            $dataContact = [];
            foreach ($contactData as $key => $contact) {
                if ($contact['phone'] || $contact['email']) {
                    $dataContact[] = [
                        'client_id' => $client->id,
                        'name' => $key,
                        'phone' => $contact['phone'],
                        'email' => $contact['email']
                    ];
                }
            }

            $client->contacts()->insert($dataContact);

            DB::commit();
            return $client;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Client $client
     * @return bool|null
     */
    public function remove(Client $client): ?bool
    {
        return $client->delete();
    }
}
