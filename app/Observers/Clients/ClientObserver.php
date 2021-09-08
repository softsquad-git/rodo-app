<?php

namespace App\Observers\Clients;

use App\Models\Clients\Client;

class ClientObserver
{
    /**
     * @param Client $client
     */
    public function deleted(Client $client)
    {
        $client->gus()->delete();
        $client->smtp()->delete();
        $client->contacts()->delete();
    }
}
