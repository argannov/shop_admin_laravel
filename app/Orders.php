<?php

namespace App;

use App\Search\Configurators\OrdersIndexConfigurator;
use App\Search\Rules\OrdersSearchRule;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Orders extends Model
{
    use Searchable;

    protected $indexConfigurator = OrdersIndexConfigurator::class;

    protected $table = 'orders';
    protected $fillable = ['id', 'user_id', 'payed', 'pay_name', 'date_payed', 'canceled', 'date_canceled', 'price', 'delivery_name', 'price_delivery', 'currency', 'updated_at', 'created_at', 'product_list', 'surname', 'name', 'last_name', 'phone', 'street', 'house', 'kvoroffice'];

    protected $searchRules = [
        OrdersSearchRule::class
    ];

    protected $mapping = [
        'properties' => [
            'pay_name' => [
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
