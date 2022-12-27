<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = ['order_id', 'product_id', 'quantity'];

    public function products()
    {
        return $this->hasMany('App\Product', 'id','product_id');
    }
    

    public function order()
    {
        return $this->hasMany('App\Order', 'id', 'order_id');
    }
}
