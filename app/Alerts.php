<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerts extends Model
{
    protected $table = 'alerts';
    protected $fillable = ['id_users','text','created_at','updated_at','visible','actions'];
}
