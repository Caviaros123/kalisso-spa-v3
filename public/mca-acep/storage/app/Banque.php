<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Banque extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'banques';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'decouvert', 'epargne', 'interet' ,'soldes', 'account_id', 'account_type', 'created_by'
    ];
}
