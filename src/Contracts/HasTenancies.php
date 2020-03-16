<?php

namespace Digitonic\Bolt\Contracts;

interface HasTenancies
{
    public function boltBrandName(): string;

    public function boltBrandCode(): string;

    public function boltKeywords(): array;

    public function boltSenders(): array;
}
