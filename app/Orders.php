<?php

namespace App;

use App\Search\Configurators\OrdersIndexConfigurator;
use App\Search\Rules\OrdersSearchRule;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

/**
 * @property $id int
 * @property $user_id int
 * @property $payed string
 * @property $pay_name string
 * @property $date_payed datetime
 * @property $delivery_name string
 * @property $price_delivery int
 * @property $price int
 * @property $canceled string
 * @property $date_canceled datetime
 * @property $updated_at datetime
 * @property $created_at datetime
 * @property $product_list string
 * @property $surname string
 * @property $name string
 * @property $last_name string
 * @property $phone string
 * @property $currency string
 * @property $street string
 * @property $house string
 * @property $kvoroffice string
 *
 * @property $user User
 *
 * Class Orders
 * @mixin \Eloquent
 * @package App
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
