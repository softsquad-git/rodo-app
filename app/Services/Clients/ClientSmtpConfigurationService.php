<?php

namespace App\Services\Clients;

use App\Models\Clients\Client;
use App\Models\Clients\ClientSmtpConfiguration;

class ClientSmtpConfigurationService
{
    /**
     * @param array $data
     * @return ClientSmtpConfiguration
     */
    public function create(array $data): ClientSmtpConfiguration
    {
        return ClientSmtpConfiguration::create($data);
    }

    /**
     * @param array $data
     * @param Client $client
     * @return Client
     */
    public function update(array $data, Client $client): Client
    {
        $client->smtp()?->update($data);

        return $client;
    }

    /**
     * @param ClientSmtpConfiguration $clientSmtpConfiguration
     * @return bool|null
     */
    public function remove(ClientSmtpConfiguration $clientSmtpConfiguration): ?bool
    {
        return $clientSmtpConfiguration->delete();
    }
}
