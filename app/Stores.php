<?php

namespace App;

use App\Search\Configurators\StoresIndexConfigurator;
use App\Search\Rules\StoresSearchRule;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

/**
 * @property $id int
 * @property $name string
 * @property $slug string
 * @property $image string
 * @property $address string
 * @property $geolocation string
 * @property $active boolean
 *
 * Class Stores
 * @mixin \Eloquent
 * @package App
 */
class Stores extends Model
{
    use Searchable;

    protected $indexConfigurator = StoresIndexConfigurator::class;

    protected $fillable = [
        'name', 'image', 'slug', 'image', 'address', 'geolocation'
    ];

    protected $searchRules = [
        StoresSearchRule::class
    ];

    protected $mapping = [
        'properties' => [
            'name' => [
                'type' => 'text',
                'analyzer' => 'rebuilt_russian',
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];
}
