<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function index()
    {
        return view('search');
    }

    /**
     * Search from database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //init
        $query = '';
        $products = '';
        
        // return "hello";
        $request->validate([
            'search' => 'required|min:3',

        ]);

        if ($request == true) {
            # code...
        $query = $request->input('search');

        $products = DB::table('products','category','profile')
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('details', 'like', '%'.$query.'%')
                    ->orWhere('description', 'like', '%'.$query.'%')->paginate(50);

        // $products = Product::search($query)->paginate(18);
        }else{
            return  view('search')->with('success_message', 'Votre recherche doit commporter plus de trois caractere');
        }


        return view('search', compact('query', 'products'));
    }


    
}
