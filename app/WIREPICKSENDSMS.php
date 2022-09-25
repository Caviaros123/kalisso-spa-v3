<?php


namespace app;


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
/**
* class MSG91 to send SMS on Mobile Numbers.
* @author Shashank Tiwari
*/


class MSG91 {

    function __construct() {

    }

    

    public function sendSMS($OTP, $mobileNumber){
        $isError = 0;
        $errorMessage = true;

        //Your message to send, Adding URL encoding.
        $message = urlencode("Bienvenue sur kalisso.com , Votre code de verification est : $OTP");
     

//         //Preparing post parameters
//         $postData = array(
//             
//             'client' => 'caviaros123',
//             'password' => 'FilsdeDieu1995',
//             'phone'=>$mobileNumber,
//             'text' => $message,
//             'from'=> 'kalisso.com'
//         );
//      
        $url = "https://api.wirepick.com/httpsms/send";
     
       // SEND SMS
				$client = new \GuzzleHttp\Client();

				$request = $client->get('https://api.wirepick.com/httpsms/send?client=caviaros123&password=FilsdeDieu1995&phone='.$mobileNumber.'&text='.$message.'&from=kalisso.com');

				$response = $request->getBody();



        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }
}
