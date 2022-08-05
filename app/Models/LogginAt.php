<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LogginAt extends Model
{

	protected $table = 'city';

    protected $fillable = ['email'];


     public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
