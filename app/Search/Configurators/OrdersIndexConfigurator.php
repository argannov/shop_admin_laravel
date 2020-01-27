<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class OrdersIndexConfigurator extends BaseConfigurator
{
    protected $name = 'orders';
}
