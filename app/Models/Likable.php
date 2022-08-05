<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Product;

trait Likable 
{

    public function scopeWithLikes(Builder $query)
    {
       $query->leftJoinSub(
           'select product_id, sum(liked) liked, sum(!liked) dislike from likes group by product_id',
           'likes',
           'likes.product_id',
           'products.id' 
       );
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->likes
                    ->where('product_id', $this->id)
                    ->where('liked', true)
                    ->count();
    }

    public function isDislikedBy(User $user)
    {
       return (bool) $user->likes
                    ->where('product_id', $this->id)
                    ->where('liked', false)
                    ->count();
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {

        $user = auth()->user() ?? auth()->user();
        $this->likes()->updateOrCreate([
                "user_id" => $user ? $user->id : auth()->id(),
            ], 

            [
                'liked' => $liked,
            ]
        );
    }


    
    
}
