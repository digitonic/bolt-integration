<?php

namespace Digitonic\Bolt\Concerns;

use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait HasTenancies
{
    /**
     * @return array
     */
    public function getContactsFromCentralisedOptouter(): array
    {
        $phoneNumbers = new Collection();
        $tables = $this->getTablesFromCentralisedOptouter();

        foreach ($tables as $table) {
            $phoneNumbers->push($this->getPhoneNumbersFromCentralisedOptouter($table));
        }

        return $phoneNumbers->flatten()->toArray();
    }

    /**
     * @param string $table
     * @return array
     */
    public function getPhoneNumbersFromCentralisedOptouter(string $table): array
    {
        try {
            return DB::connection('bolt')->table($table)->pluck('mobile')->toArray();
        } catch (QueryException $e) {
            Log::error($e->getMessage());
        }

        return [];
    }

    /**
     * @return array
     */
    public function getTablesFromCentralisedOptouter(): array
    {
        $tables = [];
        $brandCode = $this->boltBrandCode();
        $keywords = $this->boltKeywords();
        $senders = $this->boltSenders();

        if (!empty($keywords) && !empty($senders)) {
            foreach ($keywords as $keyword) {
                foreach ($senders as $sender) {
                    $tables[] = $brandCode . '_' . $keyword . '_' . $sender;
                }
            }
        }

        return $tables;
    }
}
