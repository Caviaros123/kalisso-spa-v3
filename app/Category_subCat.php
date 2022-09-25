<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_subCat extends Model
{
    protected $table = 'category_subCat';

    protected $fillable = ['category_id', 'subCat_id'];
}
