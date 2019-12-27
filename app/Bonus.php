<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonuses';
    protected $fillable = ['id_users','val_bonus','active','created_at','updated_at','card_number'];
}
