<?php

namespace App\Http\Controllers;


use App\Product;
use App\Profile;
use App\CakeProduct;
use App\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if ($products=Product::where('slug', $slug)->firstOrFail()) {

            $products;

        }

        // init
        $viewer='';
        $mightAlsoLike ='';

        $viewer= Product::where('slug', $slug)->firstOrFail();

        $catFetch = json_decode($viewer->category);

        // dd($catFetch);

        $mightAlsoLike = Product::where('slug', '!=', $slug)->whereJsonContains('category', $catFetch)->inRandomOrder()->get();

       

        //$products= Product::where('slug', $slug)->firstOrFail() CakeProduct::where('slug', $slug)->firstOrFail();

        // $mightAlsoLike = Product::where('slug', '!=', $slug)->whereIn('category', $catFetch)->inRandomOrder()->take(4)->get();

        $stockLevel = getStockLevel($products->stock);

        $getProduct = Product::where('slug', $slug)->first();


        $getStore = Profile::where('email', $getProduct->email)->first();


        return view('cart.show')->with([

            'products' => $products,
            'stockLevel' => $stockLevel,
            'mightAlsoLike' => $mightAlsoLike,
            'getStore' => $getStore,


        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
