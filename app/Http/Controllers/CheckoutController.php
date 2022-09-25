<?php

namespace App\Http\Controllers;

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




class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {


            if (Cart::content()->count() <= 0) {

                $statut = session()->flash('errors', collect(['Vous n\'avez pas de panier pour effectuer une commande']));
                return redirect('/category')->with('statut');

                // return redirect()->to('/category')->with('errors', 'Vous n\'avez pas de panier pour effectuer une commande');
            }else{

                return view('cart.checkout')->with([
                    'discount'      => $this->getNumbers()->get('discount'),
                    'newSubtotal'   => $this->getNumbers()->get('newSubtotal'),
                    'newTax'        => $this->getNumbers()->get('newTax'),
                    'newTotal'      => $this->getNumbers()->get('newTotal') >= 7500 ? $this->getNumbers()->get('newTotal') : $this->getNumbers()->get('newTotal') ,

                ]);
            }
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        // init
        // dd($request->all());
        $phone_number = phoneNumber(auth()->user()->phone);
        $amount= $this->getNumbers()->get('newTotal');
        $code = $request->payment_autorization_code;
        $pin_code = $request->pin_code;
        $error = '';

        // CREATION VARIBLE SESSION
        $data = $request->all();

        $request->session()->put('datas', $data);


        if ($this->productsAreNoLongerAvailable()) {

            return back()->withErrors('Desoler ! L\'un des produits de votre panier n\'est plus disponible');
        }

        //inserez la commandes dans la base de donnees et dans Stripe 

        // $contents = Cart::content()->map(function ($item){
        //     return 'Votre achat de '.$item->model->slug.' sur Kalisso.com, quantite = '.$item->qty. ', prix = '.presentPrice($this->getNumbers()->get('newTotal'))  ;     })->values()->toJson();


        $contents = Cart::content()->map(function ($item){
            return 'Achat de '.$item->model->name.' sur Kalisso.com, quantite = '.$item->qty. ', prix = '.presentPrice($this->getNumbers()->get('newSubtotal'));
        })->values()->toJson();

        $message = "Une nouvelle commande a été passée sur kalissom.com par : ".$request->name;
//dd($contents);


//PAIEMENT PAR DIGIBOX
        if ($request->payment_gateway == 'epay') {

         try {

            $order = $this->addToOrdersTables($request, $error);
            Mail::send(new OrderPlaced($order));

            if ($request->save_address == 'on') {
                if(\DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->get() != null) {

                    \DB::table('tbl_address')->where('user_id', auth()->id())->where('default_address', 1)->update([
                        'default_address'=> false,
                    ]);

                    try{
                        \DB::table('tbl_address')->insert([
                            'user_id' => auth()->id(), 
                            'title'=> $request->title ?? '#'.rand(100000, 999999), 
                            'recipient_name'=> $request->name.' '.$request->lastname, 
                            'phone_number'=> $request->phone, 
                            'address_line1'=> $request->address, 
                            'address_line2'=> $request->address2 ?? null, 
                            'state'=> $request->city, 
                            'country'=> $request->country, 
                            'postal_code'=> $request->postal_code ?? null, 
                            'default_address'=> true, 
                            'created_at'=> NOW(), 
                            'updated_at'=> NOW()
                        ]);
                    }catch(\Exception $e){
                        $error = $e;
                    }
                }else{
                    
                }
            }

            session()->flash('success_validate', collect(['Validez votre commande en suivant les étapes']));
            return back();

        } catch (\Exception $e) {
            return back()->withErrors('Une erreur est survenue : '. $e->getMessage());
        }
    }
}

protected function addToOrdersTables($request, $error)
{

        // inserez la commandes dans la base de donnees
        // dd($request->all());
  $order = Order::create([
    'user_id'                   => auth()->user() ? auth()->id() : null,
    'billing_email'             => $request->email,
    'billing_name'              => $request->name.' '.$request->lastname,
    'billing_adress'            => $request->address,
    'billing_city'              => $request->city,
    'billing_country'           => $request->country,
    'billing_phone'             => $request->phone,
    'transaction_id'            => $request->Reference,
    'billing_discount'          => getNumbers()->get('discount'),
    'billing_discount_code'     => getNumbers()->get('code'),
    'billing_subtotal'          => getNumbers()->get('newSubtotal'),
    'billing_tax'               => getNumbers()->get('newTax'),
    'billing_total'             => getNumbers()->get('newTotal'),
    'payment_gateway'           => $request->payment_gateway,
    'paymentStatus'             => 'order_pending', // order_confirmed or order_failed
    'error'                     => $error,
    'pin_code'                  => rand(100000, 999999),

]);

            // Boucle d'insertion de chaque produits dans la table ORDER_PRODUCT
  foreach (Cart::content() as $item) {
     OrderProduct::create([
        'order_id' => $order->id,
        'product_id' => $item->model->id,
        'quantity' => $item->qty,

    ]);
 }

 return $order;
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paypalCheckout(CheckoutRequest $request)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'b7knkqgc59yn9nxc',
            'publicKey' => '6yx9hqpzr6xq3bx3',
            'privateKey' => '354f8710e4e7bad05a1a62573a9b0846'

        ]);
        
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
                // 'customer' => [
                //     'firstNmae' => 'Prince',
                //     'lastName'  => 'Caviaros',
                //     'email'  => 'cavairos123@gmail.com',
                // ],

            'options' => [
                'submitForSettlement' => true
            ]

        ]);

        $transaction = $result->transaction;
        
        if ($result->success) {

            $order = $this->addToOrdersTablesPaypal(
                $transaction->paypal['payerEmail'],
                $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                null
            );

            Mail::send(new OrderPlaced($order));

            // decrease the quantities of all the products in the cart
            $this->decreaseQuantities();

            Cart::instance('default')->destroy();
            session()->forget('coupon');


            return redirect('/merci')->with('success_message', 'Transaction réussie. Le numero de Reference est : '.$transaction->id);

        }else {
           $order = $this->addToOrdersTablesPaypal(
            $transaction->paypal['payerEmail'],
            $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
            $result->message
        );

           return back()->withErrors('Une erreur a été rencontrer : '.$result->message);
       }


       return $paypalToken = $gateway->ClientToken()->generate();


   }

   public function momoPay(CheckoutRequest $request) 
   {   

        // dd($request->all());


        // 'phone' => 'required|numeric|size:9' validation
    if ($this->productsAreNoLongerAvailable()) {

        return back()->withErrors('Desoler ! L\'un des produits de votre panier n\'est plus disponible');
    }


    if ($request->submit == 'DigiBOX') {

        $message = 'E-Wallet DigiBOX paiement';

    }

    $this->decreaseQuantities();

    Cart::instance('default')->destroy();

    session()->forget('coupon');

    $order = $this->addToOrdersTables($request, null);

        // Mail::send(new OrderPlaced($order));

    return redirect('/merci')->with('success_message', $message);
}


protected function decreaseQuantities()
{
    foreach (Cart::content() as $item) {

        $product = Product::find($item->model->id);

        $product->update(['stock' => $product->stock - $item->qty]);
    }
}

protected function productsAreNoLongerAvailable()
{
    foreach (Cart::content() as $item) {
        $product = Product::find($item->model->id);
        if ($product->stock < $item->qty) {
            return true;
        }
    }

    return false;
}

public function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax ;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}


public function sendPaymentDigibox()
{
            // int
   foreach (Cart::content() as $item) {
       $getProduct = Product::where('id',$item->model->id)->first();



   }

   $verify = User::where('email', $getProduct->email)->first();

   $phone  = $verify->phone;
   $amount = $this->getNumbers()->get('newSubtotal');

   $contents = Cart::content()->map(function ($item){
    return 'Achat de '.$item->model->name.' sur Kalisso.com, quantite = '.$item->qty. ', prix = '.presentPrice($this->getNumbers()->get('newSubtotal'));
})->values()->toJson();



   try {


    $headers = [
        'Accept' => 'application/json; charset=UTF-8',
        'apiClientCode' => '1580436250',
        'apiClientToken' => '15523Tdy2Jx5S07LM81Qh4',

    ];

    $client = new GuzzleClient([
        'headers' => $headers
    ]);

    $res = $client->post('http://www.digibox.cg/api/momo/digibox/send-payment', [
        'form_params' => [
            'phone' => '+242'.$phone,
            'amount' => $amount,
            'motive' =>  $contents,

        ]
    ]);

    $response = $res->getBody()->getContents();

    return $response;                                                         


} catch (\Exception $e) {

  return $result = back()->withErrors('Une erreur est survenue a l\'envoi du paiement: '.$e->getMessage());

}

}
}
