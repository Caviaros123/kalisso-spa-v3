<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';

    protected $fillable = [
    		'name' , 'slug'
    ];

    public function products()
    {
    	return $this->belongsToMany('App\Models\Product');

    }

    public function subcategory()
    {
    	return $this->hasMany('App\Models\Subcategory');
    }
}
