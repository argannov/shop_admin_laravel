<?php

namespace App\Search\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class BaseConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $settings = [
        'analysis' => [
            'filter' => [
                'russian_stop' => [
                    'type' => 'stop',
                    'stopwords' => '_russian_'
                ],
                'russian_stemmer' => [
                    'type' => 'stemmer',
                    'language' => 'russian'
                ],
            ],
            'analyzer' => [
                'rebuilt_russian' => [
                    'tokenizer' => 'standard',
                    'filter' => [
                        'lowercase',
                        'russian_stop',
                        'russian_stemmer'
                    ]
                ]
            ]
        ]
    ];
}
