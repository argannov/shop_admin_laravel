<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class GoodsIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'goods';

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
