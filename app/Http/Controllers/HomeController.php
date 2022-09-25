<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Helpers;
use App\Mail;
use Brian2694\Toastr\Facades\Toastr;


class HomeController extends Controller
{
	
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        // if (auth()->user() && auth()->user()->email_verified_at == null) {

    
        // Toastr::success('Veuillez verifer votre boite email afin de confirmer votre email:)','Success');

        //     return redirect('/email/verify');
        // }


        $category = Category::all();
        $product = Product::inRandomOrder()->take(24)->get();
        $mightAlsoLike = Product::latest()->inRandomOrder()->take(20)->get();

        // Toastr::success('Post added successfully :)','Success');

        if(!empty(auth()->user()->isSeller) &&  auth()->user()->role_id == null ){

            return redirect()->to("/adminSignUp"); 

        }

        return view('home', compact('product', 'category','mightAlsoLike'));
    }

    


}
