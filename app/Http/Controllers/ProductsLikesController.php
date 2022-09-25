<?php

namespace App\Http\Controllers;

use App\Events\ProductLiked;
use App\Events\SmsNotify;
use Illuminate\Http\Request;
use App\Product;
use App\Profile;
use App\Notify;
use App\Like;
use Mckenziearts\Notify\Facades\LaravelNotify;

class ProductsLikesController extends Controller
{
    public function store(Request $request)
    {
          // init
        $user = auth()->user();

        $product= Product::find($request->id);
        $product->like($user);

       

        event(new ProductLiked($product->id, $user)); // fire the event
        // return '';
        $getProduct = Product::where('id', $request->id)->first();

        $getStore = Profile::where('email', $getProduct->email)->first();


      
        $message = auth()->user()->name." a liker vore produit sur kalisso.com";
        $datas = array(
            'name' => auth()->user()->name ?? auth()->user()->lastname,
            'phone' => $getStore->phone,
            'email'=> $getStore->email

        );

        $data= '';

        notify($message, $data);

        return back();
    }

    public function destroy($id)
    {
 
        Like::where('user_id', auth()->user()->id)->where('product_id', $id)->delete();

        return back();
    }
}
