<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ServerException;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = auth()->user()->orders; //n + 1 issues
       
        $orders = auth()->user()->orders()->with('products')->latest()->get(); //n + 1 issues
        return view('mon-compte', compact('orders'));
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
    public function show(Order $order)
    {
        
         if (auth()->user()->id =! $order->user_id) {
            return back()->with('success_message', 'Vous n\'avez pas accès à ce lien');
        } 


        $products = $order->products;

        return view('mes-commande')->with([
            'order' => $order,
            'products' => $products,
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
        // init
        $pin_code = $request->pin_code ?? 1234;
        $get_pin_code = Order::where('id', $id)->first();

        
        
        if ($request->shippedValidation == 'sendId') {

             session()->flash('dataId', $id);

            
            return redirect()->to('/delivery')->with('success_message', 'Saisissez le pin de vérification que vous avez recu par sms suite à votre commande ');


        } elseif ($request->shippedValidation == 'confirm') {

            // init 
            $contents = "Livraison du produit avec l'Id ".$id;
           
           if ($pin_code == $get_pin_code->pin_code) {

                 Order::where('id', $id)->update([
                     'shipped' => 1
                 ]);

                 //sendPaymentDigibox();

                 session()->forget('dataId');

                 return redirect()->to('/delivery')->with('validated', '<br>Merci de votre confirmation de livraison, kalisso.com vos achats, notre priorité');

           } else{

             return redirect()->to('/delivery')->withErrors('Echec, le code que vous avez rentrer ne correspond pas a celle de la commande');    

           }
           
        }else{

             return redirect()->to('/delivery')->withErrors('Echec nous n\'avons pas pu confirmer cette livraison');    
           
        }
        

        
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
