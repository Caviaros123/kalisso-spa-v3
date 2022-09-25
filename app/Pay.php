<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pay extends Model
{
    protected $table = 'pays';

    protected $fillable = [
    		'name' , 'slug'
    ];

    public function cities()
    {
    	return $this->belongsToMany('App\City');

    }
}
