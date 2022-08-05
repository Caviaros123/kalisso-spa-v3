<?php

namespace App\Models;

use Doctrine\DBAL\Cache\QueryCacheProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpKernel\EventListener\ProfilerListener;

class Order extends Model
{

    use Notifiable;

	protected $fillable = ['user_id','billing_email','billing_name','billing_adress','billing_city','billing_phone','billing_discount','billing_discount_code','billing_subtotal','billing_tax','billing_total','error', 'payment_gateway', 'paymentStatus', 'shipped', 'transaction_id', 'pin_code','billing_country',
	];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
