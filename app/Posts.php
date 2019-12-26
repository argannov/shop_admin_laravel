<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = ['id','author_id','category_id','title','anons','body','image','slug','meta_description','meta_keywords','status','created_at','updated_at'];
}
