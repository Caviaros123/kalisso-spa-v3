<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AboutPage extends Model
{
    protected $table = 'about_page';

    protected $fillable = ['title', 'text'];

}
