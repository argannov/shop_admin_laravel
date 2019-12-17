<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = "goods";
    protected $fillable = ['id,title','category','article','slug','body','image_anons','image_detail','meta_description','meta_keywords','price','status','created_at','updated_at'];
    protected $dates = ['created_at','updated_at'];
}
