<?php

namespace App;

use App\Search\Configurators\GoodsIndexConfigurator;
use App\Search\Rules\GoodsSearchRule;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Goods extends Model
{
    use Searchable;

    protected $indexConfigurator = GoodsIndexConfigurator::class;

    protected $table = "goods";
    protected $fillable = ['id','title','category','article','slug','body','image_anons','image_detail','meta_description','meta_keywords','price','status','created_at','updated_at'];
    protected $dates = ['created_at','updated_at'];

    protected $searchRules = [
        GoodsSearchRule::class
    ];

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];
}
