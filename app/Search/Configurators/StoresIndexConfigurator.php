<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class StoresIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}
