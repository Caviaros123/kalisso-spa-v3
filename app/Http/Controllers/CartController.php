<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use \App\Product;
use \App\Panier;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        // init
        loadCart(); 
           

        return view('cart.index');
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

         //dd($request->all());    
        // init 
        $identifier = auth()->user() ? auth()->user()->id : '';
        $duplicates = '';
        $images = '';
        $details = '';
        $found = '';

        if ($request->send == 'addToCart') {
            //process save and create cart
            
            if (auth()->user()) {

                // $duplicates = Cart::search( function ($cartItem, $rowId) use ($request){
                //     return $cartItem->id === $request->id;
                // });

                // if ($duplicates->isNotEmpty()) {

                //     return redirect()->route('cart.index')->with('errors', 'Ce produit existe déja dans votre panier!');
                // }
                $duplicates = Cart::search( function ($cartItem, $rowId) use ($request){
                    return $cartItem->id === $request->id;
                });

                if ($duplicates->isNotEmpty()) {

            
                    session()->flash('errors', collect(['Ce produit existe déja dans votre panier! veuillez mettre a jour la quantité pour avoir plus d\'un produit dans votre panier']));
                    return redirect()->route('cart.index');

                   
                }

                $images = $request->image;
                $details = $request->details;

                Cart::add($request->id, $request->name, 1, $request->price,0, compact('images','details'))->associate('App\Product');

             

                return redirect()->route('cart.index')->with('success_message', 'Nouveau produit ajouter<br>votre panier est sauvegarder!');

                // }    


            }else{

                $duplicates = Cart::search( function ($cartItem, $rowId) use ($request){
                    return $cartItem->id === $request->id;
                });

                if ($duplicates->isNotEmpty()) {

                    return redirect()->route('cart.index')->with('success_message', 'Ce produit existe déja dans votre panier!');
                }

                $images = $request->image;
                $details = $request->details;

                Cart::add($request->id, $request->name, 1, $request->price,0, compact('images','details'))->associate('App\Product');

                return redirect()->route('cart.index')->with('success_message', '<div class="alert text-danger">Votre panier est temporaire, il sera perdu si vous fermer cette fenêtre</div>Connectez vous pour ne pas perdre votre panier<br>');
            }

        } elseif ($request->send == 'addToCheckout') {



            // init

            $images = $request->image;
            $details = $request->details;

            Cart::add($request->id, $request->name, 1, $request->price,0, compact('images','details'))->associate('App\Product');

            return redirect()->route('checkout.index')->with('validated', 'Veuillez finalisez votre commande en indiquant une adresse de livraison valide, merci!!!');
           
        } else{

            if (auth()->user()) {

                
                $duplicates = Cart::search( function ($cartItem, $rowId) use ($request){
                    return $cartItem->id === $request->id;
                });

                if ($duplicates->isNotEmpty()) {

            
                    session()->flash('errors', collect(['Ce produit existe déja dans votre panier! veuillez mettre a jour la quantité pour avoir plus d\'un produit dans votre panier']));
                    return redirect()->route('cart.index');

                   
                }

                $images = $request->image;
                $details = $request->details;

                Cart::add($request->id, $request->name, 1, $request->price,0, compact('images','details'))->associate('App\Product');

               

                return redirect()->route('cart.index')->with('success_message', 'Nouveau produit ajouter<br>votre panier est sauvegarder!');

                // }    


            }else{

                $duplicates = Cart::search( function ($cartItem, $rowId) use ($request){
                    return $cartItem->id === $request->id;
                });

                if ($duplicates->isNotEmpty()) {

                    return redirect()->route('cart.index')->with('success_message', 'Ce produit existe déja dans votre panier!');
                }

                $images = $request->image;
                $details = $request->details;

                Cart::add($request->id, $request->name, 1, $request->price,0, compact('images','details'))->associate('App\Product');

                return redirect()->route('cart.index')->with('success_message', '<div class="alert text-danger">Votre panier est temporaire, il sera perdu si vous fermer cette fenêtre</div>Connectez vous pour ne pas perdre votre panier<br>');
            }
        }

        
    }

   /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
   public function show($slug)
   {
        // init
        $viewer='';
        $mightAlsoLike ='';

        $viewer= Product::where('slug', $slug)->firstOrFail();

        $catFetch = json_decode($viewer->category);

       //dd($catFetch);

        $mightAlsoLike = Product::where('slug', '!=', $slug)->whereIn('category', $catFetch	)->inRandomOrder()->get();

        $getStore = Profile::where('email', $viewer->email)->first();

        return view('cart.show')->with([

            'viewer' => $viewer,
            'getStore' => $getStore,
            'mightAlsoLike' => $mightAlsoLike,

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


        $validator = Validator::make($request->all(), [

            'quantity' => 'required|numeric|between: 1,10',

        ]);

        if ($validator->fails()) {

            session()->flash('errors', collect(['La quantité doit être comprise entre 1 et 10 maximum !']));

            return response()->json(['success'=> false], 400);
        }

        if ($request->quantity > $request->productStock) {

            session()->flash('errors', collect(['Il n\'y a pas assez de produit en stock pour la quantité que vous souhaitez']));

            return response()->json(['success'=> false], 400);
        }


        Cart::update($id , $request->quantity); 


       

        if (auth()->user()) {


            // Boucle de mise a jour de chaque produits dans la table Panier de l'utilisateur connecté
            foreach (Cart::content() as $item) {

               Panier::where('product_id', $item->id)->where('user_id', auth()->user()->id)->update([

                'quantity' => $item->qty


            ]);

           }
       }

       session()->flash('success_message', 'La quantité a été mise à jour avec success !');

        // return response()->json(['success' => true]);
       return response()->json(['success' => true]);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $rowId)
    {

        // $identifier = auth()->user() ? auth()->user()->email : 'UserTemp';
        // Cart::erase($identifier);

        if (auth()->user()) {
            // Boucle de suppression de chaque produits dans la table Panier de l'utilisateur connecté

            Panier::where('product_id', $request->id)->where('user_id', auth()->user()->id)->delete();

        }
        
        Cart::remove($rowId);

        return back()->with('success_message', 'Le produit a bien été éffacer!');
    }


    /**
     *Switch item for shopping cart to save for later.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater(Request $request, $id)
    {
        // dd($request->all());

        // $item = Cart::get($id);



        $duplicates = Cart::instance('wishlist')->search( function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {

            return redirect()->route('cart.index')->with('errors', 'Ce produit existe déja dans votre panier!');
        }


        $images = $request->image;
        $details = $request->details;
        // Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price,0,compact('images'))
        //     ->associate('App\product');

        Cart::instance('wishlist')->add($request->id, $request->name, 1, $request->price,0, compact('images','details'))->associate('App\Product');

        session()->flash('success_message', 'L\'article a bien été ajouter dans vos favoris !');
        return back()->with('success_message', 'L\'article a bien été ajouter dans vos favoris ');
    }


}
