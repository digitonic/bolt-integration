<?php

namespace Digitonic\Bolt\Contracts;

use Illuminate\Support\Collection;

interface HasTenancies
{
    public function boltBrandName(): string;

    public function boltBrandCode(): string;

    public function boltKeywords(): array;

    public function boltSenders(): array;

    public function getPhoneNumbersFromCentralisedOptouter(): array;

    public function getContactsFromCentralisedOptouter(array $columns = ['*']): Collection;

    public function getTablesFromCentralisedOptouter(): array;
}
