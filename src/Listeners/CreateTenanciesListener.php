<?php

namespace Digitonic\Bolt\Listeners;

use Digitonic\Bolt\Events\CreateTenancies;
use Digitonic\Bolt\Services\BoltClient;

class CreateTenanciesListener
{
    /**
     * @param CreateTenancies $event
     */
    public function handle(CreateTenancies $event)
    {
        $client = resolve(BoltClient::class);
        $tenancies = [];

        foreach ($event->tenant->boltSenders() as $sender) {
            if (is_numeric($sender)) {
                $tenancies[] = [
                    'brand_name' => $event->tenant->boltBrandName(),
                    'brand_code' => $event->tenant->boltBrandCode(),
                    'keyword' => $event->keyword,
                    'receiver' => $sender,
                ];
            }
        }

        $client->createTenancies($tenancies);
    }
}
