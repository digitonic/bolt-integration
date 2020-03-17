<?php

namespace Digitonic\Bolt\Contracts;

interface HasTenancies
{
    public function boltBrandName(): string;

    public function boltBrandCode(): string;

    public function boltKeywords(): array;

    public function boltSenders(): array;

    public function getContactsFromCentralisedOptouter(): array;

    public function getPhoneNumbersFromCentralisedOptouter(string $table): array;

    public function getTablesFromCentralisedOptouter(): array;
}
