<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => 'required|numeric',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Echec de validation'
            ], 400);

        }

        try {

             $duplicated = \DB::table('tbl_shopping_cart')
                ->where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            

            if ($duplicated != null) {
                
                \DB::table('tbl_shopping_cart')
                    ->where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->update([
                        'qty' => $duplicated->qty + 1
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Le produit existe déjà, La quantité du produit à été mise à jour'
                ], 200);

            } else{
                \DB::table('tbl_shopping_cart')->insert([
                    'user_id' => Auth::id(),
                    'product_id' => request()->get('product_id'),
                    'qty' => 1
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Le produit à bien été ajouter à votre panier'
                ], 201);

            }
            
        } catch (Exception $e) {

             return response()->json([
                    'success' => false,
                    'message' => $e
                ], 400);
            
        }
       
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => 'required|numeric',
            'actions' => 'required|string'

        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Echec de validation'
            ], 400);

        }

        $duplicated = \DB::table('tbl_shopping_cart')
                        ->where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->first();
        try {
            
                if ($request->actions == 'increment') {

                     \DB::table('tbl_shopping_cart')
                        ->where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->update([
                            'qty' => $duplicated->qty + 1
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'La quantité du produit à été mise à jour +'
                    ], 200);

                } else if ($request->actions == 'decrease') {

                     \DB::table('tbl_shopping_cart')
                        ->where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->update([
                            'qty' => $duplicated->qty >= 2 ? $duplicated->qty - 1 : $duplicated->qty
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'La quantité du produit à été mise à jour -'
                    ], 200);
                }

          } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e
                ], 400);
          } 
    }



    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => 'required|numeric',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Echec de validation'
            ], 400);

        }

            $duplicated = \DB::table('tbl_shopping_cart')
                ->where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            

            if ($duplicated == null) {
                
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun produit à supprimer'
                ], 400);
            }

        try {

            \DB::table('tbl_shopping_cart')
                ->where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Le produit à bien été supprimer de votre panier'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }

        
    }
}
