<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ServerException;


class MerciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
              

                // $reqPayment = array(

                //     'status' => , 
                //     'transaction_id' => , 
                //     'amount' => , 
                //     'currency' => , 
                //     'transaction_date' => , 
                //     'Reference' => , 
                //     'PaymentMethod' => , 
                //     'paymentID' => , 



                // );
                // status=            FAILED
                // &transaction_id=   0167749875990
                // &amount=           118.00
                // &currency=         XAF
                // &transaction_date= 2020-11-16T15:18:25
                // &Reference=        297712034
                // &PaymentMethod=    mtn
                // &paymentID= 

        if (isset($_GET['status'])) {
            

   Mail::send(new OrderPlaced($order));
                
          

             if ($_GET['status'] == 200 || $_GET['status'] == 'SUCCESSFUL') {

				$sms= Order::where('transaction_id', $_GET['transaction_id'])->first();


$contents = Cart::content()->map(function ($item){
                return 'Achat de '.$item->model->slug.' sur Kalisso.com, quantite = '.$item->qty. ', prix = '.presentPrice(getNumbers()->get('newTotal'));
            })->values()->toJson();



	// SEND SMS
				$client = new \GuzzleHttp\Client();

				$request = $client->get('https://api.wirepick.com/httpsms/send?client=caviaros123&password=FilsdeDieu1995&phone=242064272080&text='.$contents.'&from=kalisso.com');

				$response = $request->getBody();



 

// $order = 
               //   $order = $this->addToOrdersTables($request, null);

                  //  Mail::send(new OrderPlaced($order));
                    
               //     $this->decreaseQuantities();

//try{


//$url = "https://api.wirepick.com/httpsms/send?client=kalisso&password=FilsdeDieu1995&phone=xxxx&text=xxxx&from=kalisso.com"
// response from the server is retuned in xml format showed in the section 2.2 above
//$response=simplexml_load_file(urlencode($url));
// accessing xml elements inside the response from the server
//$status = $response->status;
//$msgid = $response->msgid;

//}catch(Exception $e){

  //  return view('merci)->with('errors', 'echec d'envoi du sms');
//}
                    Cart::instance('default')->destroy();

                    session()->forget('coupon');

                    session()->forget('datas');

return view('merci')->with('success_message', 'Votre commande a bien été enregistrer et est en cours de livraison, vous recevrez des notifications pas sms et ou par email \n Merci d\'avoir fait confiance a kalisso pour votre commande') ;
             }elseif ($_GET['status'] == 'FAILED') {
                 
             return view('merci')->withErrors('echec de paiement');
        }

        return view('merci');
    }

return view('merci');
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
 protected function addToOrdersTables($request, $error)
    {

        // inserez la commandes dans la base de donnees
        // dd($request->all());
          $order = Order::where('transaction_id', $_GET['transaction_id'])->get();

           

            return $order;
    }


}
