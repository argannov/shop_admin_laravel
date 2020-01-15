<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id int
 * @property $name string
 * @property $slug string
 * @property $image string
 * @property $address string
 * @property $geolocation string
 * @property $active boolean
 *
 * Class Stores
 * @mixin \Eloquent
 * @package App
 */
class Stores extends Model
{
    protected $fillable = [
        'name', 'image', 'slug', 'image', 'address', 'geolocation'
    ];
}
