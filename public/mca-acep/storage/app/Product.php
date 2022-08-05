<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{   
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'details', 'prix', 'adresse', 'ville', 'options', 'type', 'services', 'email', 'created_by', 'isBanner', 'image', 'images', 'tags', 'new', 'slug'];
}
