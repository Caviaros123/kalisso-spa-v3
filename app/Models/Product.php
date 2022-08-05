<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Product as VoyagerProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;    
use App\Models\Like;
use App\Models\User;
use App\Models\Profile;


class Product extends Model
{

    use Likable, Notifiable;

    protected $guarded = [];

    protected $table = 'products';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'slug', 'details', 'description', 'price', 'etat', 'old_price', 'category', 'stock', 'image', 'images', 'email', 'featured', 'store_id', 'location', 'livraison', 'rating', 'review'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

   	public function categories()
    {
    	return $this->belongsToMany('App\Models\Category');

    }

    public function likes()
    {
    	return $this->hasMany('App\Models\Like');

    }

    public function reviews()
    {
         return $this->hasMany('App\Models\ProductReview', 'id', 'user_id');
    }

    public function boutique()
    {
        return $this->hasOne(Profile::class);

    }

    public function seller()
    {
        return $this->hasOne(Profile::class);

    }

     public function searchableAs()
    {
        return 'Product';
    }

}
 



