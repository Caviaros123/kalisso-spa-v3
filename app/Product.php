<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Product as VoyagerProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\User;
use App\Profile;


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


    public static function allProducts()
    {
        return self::where('featured', 1)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function reviews()
    {
        return $this->hasMany('App\ProductReview', 'id', 'user_id');
    }

    public function boutique()
    {
        return $this->hasOne(Profile::class);
    }

    public function searchableAs()
    {
        return 'Product';
    }
}
