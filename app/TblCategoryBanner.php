<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblCategoryBanner extends Model
{
    protected $table = 'tbl_category_banner';

    protected $fillable = [
    		'category_id' , 'banner_id'
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');

    }

    public function banner()
    {
    	return $this->belongsTo('App\Banner');

    }
}
