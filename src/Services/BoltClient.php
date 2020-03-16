<?php

namespace Digitonic\Bolt\Services;

use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class BoltClient
{
    /**
     * @var GuzzleHttp
     */
    protected $client;

    public function __construct(GuzzleHttp $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $tenancies
     */
    public function createTenancies(array $tenancies): void
    {
        foreach ($tenancies as $tenancy) {
            $this->sendTenancyRequest($tenancy);
        }
    }

    /**
     * @param array $tenancy
     */
    private function sendTenancyRequest(array $tenancy): void
    {
        try {
            $this->client->post('tenancies', ['json' => $tenancy]);
        } catch (ClientException $e) {
            Log::error($e->getMessage());
        }
    }
}
