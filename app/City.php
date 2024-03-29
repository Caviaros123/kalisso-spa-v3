<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    protected $table = 'city';

    protected $fillable = [
    		'name' , 'slug'
    ];

    public function countries()
    {
    	return $this->belongsToMany('App\City');

    }
}
