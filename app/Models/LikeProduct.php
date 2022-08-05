<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeProduct extends Model
{

    protected $guarded = [];

    protected $table = 'like_products';

    protected $fillable = ['user_id', 'product_id', 'liked'];

}
