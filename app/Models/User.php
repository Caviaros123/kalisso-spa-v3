<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Likable;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Likable, Notifiable;

    protected $guarded = ['users'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'lastname', 'otp', 'phone', 'email', 'password', 'isSeller', 'avatar', 'remember_token','phone_verified_at', 'registered_from', 
    ];

    public function searchableAs()
    {
        return 'users_index';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

     public function loggedAt()
    {
        return $this->belongsToMany('App\Models\LogginAt');
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


    public function timeline()
    {
        $friends = $this->follows()->pluck('id');

        return Product::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->latest()
            ->withLikes()
            ->orderByDesc('id')
            ->paginate(50);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function path($append = '')
    {
        $path = route('profile', $this->username);
        return $append ? "{$path}/{$append}" : $path;
    }

    public static function checkToken($token){
        if($token != null){
            return true;
        }
        return false;
    }
   

}
