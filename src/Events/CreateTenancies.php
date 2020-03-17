<?php

namespace Digitonic\Bolt\Events;

use Digitonic\Bolt\Contracts\HasTenancies;
use Illuminate\Queue\SerializesModels;

class CreateTenancies
{
    use SerializesModels;

    /**
     * @var string
     */
    public $keyword;

    /**
     * @var HasTenancies
     */
    public $tenant;

    /**
     * CreateTenancies constructor.
     * @param string $keyword
     * @param HasTenancies $tenant
     */
    public function __construct(string $keyword, HasTenancies $tenant)
    {
        $this->keyword = $keyword;
        $this->tenant= $tenant;
    }
}
