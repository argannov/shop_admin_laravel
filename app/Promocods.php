<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocods extends Model
{
    protected $table='promocods';
    protected $fillable=['id','discount_name','active','coupon','date_apply','created_at','updated_at'];
}
