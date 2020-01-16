<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class OrdersIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'orders';

    protected $settings = [
        'analysis' => [
            'analyzer' => [
                'es_std' => [
                    'type' => 'standard',
                    'stopwords' => '_spanish_'
                ]
            ]
        ]
    ];
}
