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
    public function getPhoneNumbersFromCentralisedOptouter(): array
    {
        return $this->getContactsFromCentralisedOptouter(['mobile'])->pluck('mobile')->toArray();
    }

    /**
     * @return Collection
     */
    public function getContactsFromCentralisedOptouter(array $columns = ['*']): Collection
    {
        try {
            $query = null;
            foreach($this->getTablesFromCentralisedOptouter() as $table) {
                if (!$query) {
                    $query = DB::connection('bolt')->table($table)->select($columns);
                    continue;
                }

                $query = $query->union(
                    DB::connection('bolt')->table($table)->select($columns)
                );
            }

            if (!$query) {
                return new Collection([]);
            }

            return $query->get();
        } catch (QueryException $e) {
            Log::error($e->getMessage());
        }

        return collect([]);
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
                    if (is_numeric($sender)){
                        $tables[] = $brandCode . '_' . $keyword . '_' . $sender;
                    }
                }
            }
        }

        return $tables;
    }
}
