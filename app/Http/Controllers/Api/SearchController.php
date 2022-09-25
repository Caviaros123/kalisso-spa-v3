<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function getSearch(Request $request){
        $request->validate([
            'query' => 'present|required|string|min:3'
        ]);

        try {
            $search = Product::where('name', 'like', '%'.$request->get('query').'%')
            ->orWhere('details', 'like', '%'.$request->get('query').'%')
            ->orWhere('description', 'like', '%'.$request->get('query').'%')
            ->get();

            if($search){
                return response()->json([
                    'success' => true,
                    'message' => count($search).' produit trouvé',
                    'data' => $search
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun produit n\'a été trouvé',
                    'data' => $search
                ], 404);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
