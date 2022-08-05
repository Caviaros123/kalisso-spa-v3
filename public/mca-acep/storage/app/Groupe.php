<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Groupe extends Model
{
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'code', 'name', 'day', 'amount','amount_fixed', 'type', 'status', 'leader_1', 'leader_2', 'leader_3', 'created_by', 'updated_by',
    ];
}
