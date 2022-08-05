<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pays_city extends Model
{
    protected $table = 'pays_cities';

    protected $fillable = ['pays_id', 'city_id'];
}
