<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Doctrine\DBAL\Driver\PDO\Exception;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validate the request
       $request->vaidate([
            'order_id' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);
        //update order payment status
        $order = Order::find($request->order_id);
        $order->payment_status = $request->payment_status;
        $order->payment_method = $request->payment_method;
        $order->save();

        //send email to user
        Mail::to($order->user->email)->send(new OrderConfirmed($order));

        //send notification to user
        $user = User::find($order->user_id);
        $user->notify(new \App\Notifications\OrderPlaced($order));
        
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //init
        $getAddress = DB::table('tbl_address')->where('default_address', 1)->where('user_id', Auth::id())->first() ?? [];
        $getCart = DB::table('tbl_shopping_cart')->where('user_id', Auth::id())->get(['product_id', 'qty']);

        $request->validate([
            'amount' => 'present|required|numeric',
            // 'cartItemList' => 'present',
            'useDefaultAddress' => 'present|boolean',
            'newAddress' => 'required_if:useDefaultAddress,==,0',
            'deliveryOption' => 'present|required|string'
        ]);

        unset($request['cartItemList']);

        $request->merge([
            'cartItemList' => $getCart
        ]); 

        if (count($request->cartItemList) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Echec de la commande votre panier est vide vous ne pouvez pas passez de commande sans avoir un panier!',
                'data' => $request->cartItemList
            ], 400);
        }

        // return $cartItem;

        // $phone_number = phoneNumber(Auth::user()->phone);
        if($request->useDefaultAddress){
            $getAddress = DB::table('tbl_address')->where('default_address', 1)->where('user_id', Auth::id())->first();
            unset($request['newAddress']);
        }else{
            // return $request;
            $phone = str_replace(" ", '', phoneNumber($request->newAddress['phone']));
            $request->merge([
                'phone' => $phone,
            ]);
            // return $request->phone;

            $request->validate([
                'newAddress' => 'present|required',
                'newAddress.name' => 'present|required|string',
                'newAddress.lastname' => 'present|required|string',
                'newAddress.email' => 'present|required|email',
                'newAddress.phone' => 'present|required|string|max:23',
                'newAddress.country' => 'present|required|string',
                'newAddress.city' => 'present|required|string',
                'newAddress.address' => 'present|required|string|min:20',
                'newAddress.saveAsDefaultAddress' => 'present|required|boolean',
            ]);

            // return $request->newAddress['saveAsDefaultAddress'];

            if($request->newAddress['saveAsDefaultAddress']){
                DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->update([
                    'default_address'=> false,
                ]);
            }
            
            DB::table('tbl_address')->insert([
               'recipient_name' => $request->newAddress['name'].' '.$request->newAddress['lastname'],
               'address_line1' => $request->newAddress['address'],
               'phone_number' => $request->phone,
               'country' => $request->newAddress['country'],
               'state' => $request->newAddress['city'],
               'title' => '#'.rand(100000, 999999),
               'default_address' => true,
               'created_at'=> NOW(), 
               'updated_at'=> NOW(),
               'user_id' => auth()->id(),
            ]);

            $getAddress = DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->first();

        }

        $checkProduct = array();
        
        if (!$getAddress) {
           return response()->json([
                'success' => false,
                'message' => 'Echec de la commande vous n\'avez pas d\'adresse de livraison!',
                'data' => $getAddress
            ], 400);
        }

        $request->merge([
            'user_id'                   => Auth::user() ? Auth::id() : null,
            'email'                     => Auth::user()->email,
            'name'                      => $getAddress->recipient_name,
            'address'                   => $getAddress->address_line1,
            'city'                      => $getAddress->state,
            'phone'                     => phoneNumber($getAddress->phone_number),
            'country'                   => $getAddress->country,
            'payment_gateway'           => $request->payment_gateway ?? 'epay',
            'Reference'                 => trim(str_replace(['-',':',' '], '', 'K'.date('dmyHis').rand(1000, 9999))),
            'paymentStatus'            => 'pending',
            'shipped'                   => false,
            'pin_code'                  => rand(1000000, 9999999),
            'shoppingcart'              => $getCart
        ]);

        foreach($request->get('shoppingcart') as $sk => $sv){
            $checkProduct[$sk] = $sv->product_id;
        }

        $countProduct = count($checkProduct);

        $resultProduct = Product::whereIn('id', $checkProduct)->get();

        if(count($resultProduct) != $countProduct) {
            return response()->json([
                'success' => false,
                'message' => 'Echec un de vos produit n\'est plus valide!',
                'data' => []
            ], 400);
        }

        // if (count($request->shoppingcart) === 0) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Echec de la commande votre panier est vide!',
        //         'data' => $request->shoppingcart
        //     ], 400);
        // }
        
        try{
            $order = $this->addToOrdersTables($request, null);
            
            // auth()->user()->notify(new OrderPlaced($order));
            Mail::send(new OrderPlaced($order));
            // Broadcast(new OrderPlaced($order));
            
             //delete user cart
            DB::table('tbl_shopping_cart')->where('user_id', Auth::id())->delete();

            return response()->json([
                'success'           => true,
                'message'           => 'Votre commande à bien été enregistrer',
                'data'              => Epay($request),
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
                'data' => $e
            ], 400);
        }
        
    }


    protected function addToOrdersTables($request, $error)
    {

        // inserez la commandes dans la base de donnees
        $order = Order::create([
            'user_id'                   => auth()->user() ? auth()->user()->id : null,
            'billing_email'             => $request->email,
            'billing_name'              => $request->name,
            'billing_adress'            => $request->address,
            'billing_city'              => $request->city,
            'billing_country'           => $request->country,
            'billing_phone'             => $request->phone,
            'transaction_id'            => $request->Reference,
            'billing_discount'          => getNumbers()->get('discount'),
            'billing_discount_code'     => getNumbers()->get('code'),
            'billing_subtotal'          => $request->amount,
            'billing_tax'               => getNumbers()->get('newTax'),
            'billing_total'             => $request->amount,
            'payment_gateway'           => $request->payment_gateway,
            'paymentStatus'             => $request->paymentStatus,
            'shipped'                   => $request->shipped,
            'error'                     => $error,
            'pin_code'                  => null,

        ]);

        // $getOrder = Order::where('transaction_id', $order->transaction_id)->first();

        // Boucle d'insertion de chaque produits dans la table ORDER_PRODUCT
        foreach ($request->get('shoppingcart') as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->qty,
            ]);
        }

        //delete user cart
        DB::table('tbl_shopping_cart')->where('user_id', Auth::id())->delete();

        return $order;
    }

}
