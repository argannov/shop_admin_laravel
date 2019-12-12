<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table= 'pages';
    protected $fillable = ['id','title','slug','body','image','meta_description','meta_keywords','status','created_at','updated_at','banners'];
    protected $dates = ['created_at','updated_at'];
   // protected $dateFormat = 'y-m-d h:i:s';
}
