<?php

namespace App\Http\Controllers;

use \App\Category;
use \App\Product;
use \App\Boutique;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = Category::all();

        return view('dashboard.product.index',compact('categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



    // if (empty($base = $request->base))
        
    //         die("missing string base64");

    //     function base64ToJpeg($base64_string) {
    //         $data = explode(';', $base64_string);
    //         $dataa = explode(',', $base64_string);
    //         $part = explode("/", $data[0]);
    //         if (empty($part))
    //             return false;
    //         $file = md5(uniqid(rand(), true)) . ".{$part[1]}";
            
    //         $ifp = fopen(public_path('product-img') . "/{$file}", 'wb');
    //         fwrite($ifp, base64_decode($dataa[1]));
    //         fclose($ifp);
    //         return $file;
    //     }

    //     foreach($base as $index => $base64) {
    //         if (!empty($base64) && !file_exists($finalFile = sprintf('%1$s/%2$s', public_path('product-img'), base64ToJpeg($base64))))
    //             die("Upload error {$finalFile} on index : {$index}");
    //     }
            
        $request->validate([
        
        'name'          => 'required',
        'description'   => 'required',
        'price'         => 'required', 
        'category'      => 'required',
        'id_produit'    => 'required',
        'stock'         => 'required',
        'image'         => 'required|image|max:2048',
        'email'         => 'required'
        ]) or die();

        $image = $request->file('image');

        if (empty($image)) 

        die('erreur image manquante ou incorrecte');

        $new_name = md5(uniqid(rand(), true)) . '.' . $image->
            getClientOriginalExtension();
        $image->move(public_path('product-img'), $new_name);

        $form_data = array(

           'name'         =>$request->name, 
           'description'  =>$request->description, 
           'price'        =>$request->price, 
           'category'     =>$request->category, 
           'id_produit'   =>$request->id_produit, 
           'stock'        =>$request->stock, 
           'image'        =>$new_name, 
           'email'        =>$request->email 
           
        );

        Product::create($form_data)or die();

        return redirect('boutique')->with('success', 'Le nouveau produit à bien été insérer !');
 


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $categorie = Categories::all();
        return view('dashboard.product.edit', compact('data','categorie'));
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
        $image_name = $request->hidden_image;
        $image = $request->file('image');

        if ($image != '') {

            $request->validate([
                
                'name'          => 'required',
                'description'   => 'required',
                'price'         => 'required', 
                'category'      => 'required',
                'id_produit'    => 'required',
                'stock'         => 'required',
                'image'         => 'image|max:2048',
                'email'         => 'required'
                ]);

        } 
        

        $image_name = md5(uniqid(rand(), true)) . '.' . $image->getClientOriginalExtension();


        $image->move(public_path('product-img'), $image_name);
        

        $form_data = array(

       'name'         =>$request->name, 
       'description'  =>$request->description, 
       'price'        =>$request->price, 
       'category'     =>$request->category, 
       'id_produit'   =>$request->id_produit, 
       'stock'        =>$request->stock, 
       'image'        =>$image_name, 
       'email'        =>$request->email 
               
        );

        Product::whereId($id)->update($form_data);

        return redirect('boutique')->with('success', 'Le produit à bien été modifier');

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Product::findOrFail($id);
        $data->delete();

        return redirect('boutique');
    }
}
