<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class PostsIndexConfigurator extends BaseConfigurator
{
    protected $name = 'posts';
}
