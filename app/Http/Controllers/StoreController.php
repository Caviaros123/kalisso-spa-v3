<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class StoreController extends Controller
{
  
   	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('create.store.index');
    }


    public function show($id)
    {
        $getStore = Profile::where('slug', $id)->firstOrFail();


        return view('shop.index')->with('getStore', $getStore);
    }
}
