<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Likable;
use App\User;

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
          'store_name', 'type', 'description', 'store_id', 'adress', 'country', 'town', 'quarter', 'street', 'phone', 'logo', 'document', 'images', 'founder_name', 'capital_price', 'email', 'code_postal', 'transaction', 'web_site', 'social_links', 'statut', 'rating', 'story', 'slug',
     ];


     public function order_product()
     {
          return $this->hasMany('App\Order', 'product_id', 'store_id');
     }

     public function user()
     {
        return $this->belongsTo(User::class, 'email', 'email');
     }


     public function products()
     {
          return $this->hasMany('App\Product', 'store_id', 'store_id');
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

     public function reviews()
     {
          return $this->hasMany('App\ProductReview', 'user_id', 'id');
     }
}
