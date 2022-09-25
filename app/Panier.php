<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
     protected $table = 'panier';

     protected $fillable = ['user_id', 'product_id', 'quantity'];
}
