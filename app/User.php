<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JWTAuth;
use Laravel\Sanctum\HasApiTokens;


class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use HasApiTokens, Likable, Notifiable;

    protected $guarded = ['users'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 
       'lastname', 
       'otp', 
       'phone', 
       'role_id', 
       'store_id', 
       'provider_id', 
       'email', 
       'password', 
       'isSeller', 
       'avatar',
       'phone_verified_at', 
       'remember_token',
       'registered_from',
       'settings'
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
        'password', 'remember_token',
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
        return $this->hasMany('App\Order');
    }

     public function loggedAt()
    {
        return $this->belongsToMany('App\LogginAt');
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
