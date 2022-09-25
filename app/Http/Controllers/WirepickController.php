<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ServerException;


class WirepickController extends Controller
{
    
    public function show()
    {
        if(auth()->user()->phone_verified_at != null){
            return redirect('/');
        }
        return view('wirepick');
    }
    


    public function verify(Request $request)
    {
        
        
        $date = date_create();

        DB::table('users')->where('id', auth()->id())->update([
            'phone_verified_at' => NOW(),
            'otp' => null
        
            ]);
        
        session()->flash('success_message', 'Félicitations '.auth()->user()->lastname.' vous êtes désormais inscrit sur la plus grande plateforme de vente ligne du Congo-Brazzaville');

        
        return redirect('/');
    

       
    }



}