<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Events\ProductLiked;
use App\Product;
use App\Profile;
use App\Notify;
use App\Like;

class WishlistController extends Controller
{


    public function check(Request $request)
    {
        $request->validate([
            'product_id' => 'present|required|numeric',
        ]);

        $id = $request->product_id;
        $user = Auth::user();

        $product = Product::find($id);

        if ($product->isLikedBy($user)) {
            return response()->json([
                'success' => true,
                'message' => 'Le produit existe dans vos favoris'
            ], 200);
        }else  {
             return response()->json([
                'success' => false,
                'message' => 'Le produit n\'existe pas dans vos favoris'
            ], 200);
        }
    }


    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'present|required|numeric',
        ]);
        
        $id = $request->product_id;
        $user = Auth::user();
        $product = Product::find($id);

        if($product != null ){
            if ($product->isLikedBy($user)) {

                Like::where('user_id', $user->id)->where('product_id', $id)->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'disliked',
                    'data' => $product
                ], 200);

            }else{

                $product->like($user);
                return response()->json([
                    'success' => true,
                    'message' => 'liked',
                    'data' => $product
                ], 200);

            }
        }else{
             //Like::where('user_id', Auth::id())->where('product_id', $id)->delete();
            return response()->json([
                'success' => false,
                'message' => 'No product found for this id',
                'data' => $product
            ]);

        }
    }


    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
        ]);

        $user = Auth::user();
        $id = $request->product_id;

        $product = Like::where('product_id', $id)->where('user_id', $user->id)->first();
        
        if ($product != null) {
            Like::where('product_id', $id)->where('user_id', $user->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Retirer de vos favoris'
            ], 200);
        }else{ 
            return response()->json([
                'success' => false,
                'message' => 'Echec de suppression, ce produit n\'existe pas dans vos favoris'
            ], 405);
        }
       
    }

}
