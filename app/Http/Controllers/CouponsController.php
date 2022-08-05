<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Jobs\UpdateCoupon;

class CouponsController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            
            return redirect()->route('checkout.index')->withErrors('Code promo invalide, veuillez réessayer s\'il vous plait');
        }


       dispatch_now(new UpdateCoupon($coupon)); 

        return redirect()->route('checkout.index')->with('success_message', 'Le Coupon a bien été appliquer!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('checkout.index')->with('success_message', 'Le Coupon a bien été retirer, vous n\'avez plus de reduction.');
    }
}
