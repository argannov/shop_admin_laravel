<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class PostsIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'posts';

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
