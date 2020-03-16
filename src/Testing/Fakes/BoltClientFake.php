<?php

namespace Digitonic\Bolt\Testing\Fakes;

use Digitonic\Bolt\Testing\BoltEnvBuilder;

class BoltClientFake
{
    /**
     * @var BoltEnvBuilder
     */
    protected $client;

    public function __construct()
    {
        $this->client = resolve(BoltEnvBuilder::class);
    }

    /**
     * @param array $tenancies
     */
    public function createTenancies(array $tenancies): void
    {
        foreach ($tenancies as $tenancy) {
            $tableName = $tenancy['brand_code'] . '_' . $tenancy['keyword'] . '_' . $tenancy['receiver'];
            $this->client->createTenancyTable($tableName);
        }
    }
}
