<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Likable;
use App\Models\User;

class Profile extends Model
{
     use Likable, Notifiable;

     protected $table = 'profiles';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
          'store_name', 
          'type', 
          'description', 
          'store_id', 
          'adress', 
          'country', 
          'state', 
          'town', 
          'quarter', 
          'street', 
          'phone', 
          'logo', 
          'document', 
          'images', 
          'founder_name', 
          'capital_price', 
          'email', 
          'code_postal', 
          'transaction', 
          'web_site', 
          'social_links', 
          'statut', 
          'rating', 
          'story', 
          'slug',
     ];


     public function products()
     {
          return $this->hasMany('App\Models\Product', 'store_id', 'store_id');
     }

     /**
      * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
      */
     public function followers()
     {
          return $this->belongsToMany(User::class, 'followers', 'store_id', 'follower_id')->withTimestamps();
     }

     /**
      * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
      */
     public function followings()
     {
          return $this->belongsToMany(User::class, 'followers', 'follower_id', 'store_id')->withTimestamps();
     }

     // public function reviews()
     // {
     //      return $this->hasMany('App\ProductReview', 'user_id', 'id');
     // }
}
