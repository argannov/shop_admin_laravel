<?php

namespace App;

use App\Search\Configurators\GoodsIndexConfigurator;
use App\Search\Rules\GoodsSearchRule;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

/**
 * @property $id int
 * @property $title string
 * @property $category string
 * @property $article string
 * @property $slug string
 * @property $body string
 * @property $image_anons string
 * @property $image_detail string
 * @property $meta_description string
 * @property $meta_keywords string
 * @property $price int
 * @property $status string
 * @property $create_at timestamp
 * @property $updated_at timestamp
 *
 * Class Goods
 * @mixin \Eloquent
 * @package App
 */
class Goods extends Model
{
    use Searchable;

    protected $indexConfigurator = GoodsIndexConfigurator::class;

    protected $table = "goods";
    protected $fillable = ['id', 'title', 'category', 'article', 'slug', 'body', 'image_anons', 'image_detail', 'meta_description', 'meta_keywords', 'price', 'status', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    protected $searchRules = [
        GoodsSearchRule::class
    ];

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                'analyzer' => 'rebuilt_russian',
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
            'body' => [
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
