<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //init
        $categoryName = '';
        $countProduct = '';
        $category = Category::all();

        //process count product
        $countProduct = DB::select("select  category.slug, category.name, count(category_product.category_id) as number from category INNER join category_product WHERE category.id = category_product.category_id group by category.name, category.slug");
    
        if (request()->category ) {

            $products = Product::with('categories')->whereHas('categories', function ($query){
                    $query->where('slug', request()->category);

            })->take(14)->paginate(14);
            
            $categoryName = optional($category->where('slug', request()->category)->first())->name;


        }else{

            $products = Product::where('featured', true)->inRandomOrder()->take(24)->get();
            $categoryName= 'Nouveaux';

        }


        if (request()->sort == 'low_high') {

            $products = $products->sortBy('price');

        }elseif (request()->sort == 'high_low') {

            $products = $products->sortByDesc('price');
        }

        return view('category', compact(
            'category',
            'countProduct',
            'products',
            'categoryName'
            
        ));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
