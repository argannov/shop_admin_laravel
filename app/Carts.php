<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table='carts';
    protected $fillable = ['id','user_id','product_id','price','currency','weight','weight_value','quantity','can_buy','discount_name','discount_coupon','reserved','date_insert','date_update'];
}
