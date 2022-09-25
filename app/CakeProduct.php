<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CakeProduct extends Model
{
    protected $table = 'category_product';

    protected $fillable = ['product_id', 'category_id'];
}
