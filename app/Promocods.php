<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $discount_name string
 * @property $active string
 * @property $coupon string
 * @property $date_apply datetime
 * @property $created_at timestamp
 * @property $updated_at timestamp
 *
 * @mixin \Eloquent
 * Class Promocods
 * @package App
 */
class Promocods extends Model
{
    protected $table = 'promocods';
    protected $fillable = ['id', 'discount_name', 'active', 'coupon', 'date_apply', 'created_at', 'updated_at'];
}
