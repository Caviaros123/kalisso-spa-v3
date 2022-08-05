<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Carte extends Model
{
    
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'code', 'amount_fixed', 'day', 'groupes_id', 'created_by','updated_by'
    ];
}
