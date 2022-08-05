<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    protected $table = 'likes';

    protected $fillable = ['user_id', 'product_id', 'liked'];

    public function products()
    {
         return $this->hasOne('App\Models\Product');
    }
    
}
