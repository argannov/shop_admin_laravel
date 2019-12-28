<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='orders';
    protected $fillable= ['id','user_id','payed','pay_name','date_payed','canceled','date_canceled','price','delivery_name','price_delivery','currency','updated_at','created_at','product_list','surname','name','last_name','phone','street','house','kvoroffice'];
}
