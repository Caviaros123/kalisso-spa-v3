<?php 

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use \App\Product;
use \App\Panier;
use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Composer\Util\Http\Response;


/**
  * MAKE AVATAR FUNCTION
  */
  if(!function_exists('makeAvatar')){
       function makeAvatar($fontPath, $dest, $char){
           $path = $dest;
           $image = imagecreate(200,200);
           $red = rand(0,255);
           $green = rand(0,255);
           $blue = rand(0,255);
           imagecolorallocate($image,$red,$green,$blue);
           $textcolor = imagecolorallocate($image,255,255,255);
           imagettftext($image,100,0,50,150,$textcolor,$fontPath,$char);
           imagepng($image,$path);
           imagedestroy($image);
           return $path;
       }
  }

function generateStoreId(string $req) : string
{
    return 'KLS'.RAND().strtoupper($req).str_replace('-','',date('d-m-Y'));
}


function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}



//formatage du prix avec un point au lieu d'une virgule
function presentPrice($price)
{
	return str_replace(',', '.', number_format($price, 0)).' Fcfa';
}



//formatage du prix avec un point au lieu d'une virgule
function phoneNumber($phone) {
    // add logic to correctly format number here
    // a more robust ways would be to use a regular expression
     //fetch phone to simplify sending
    if (substr( $phone, 0, 1 ) === "+") {
    
        $phone = str_replace('+', '', $phone);
        
    }elseif (substr( $phone, 0, 2 ) === "00") {
    
        $phone = str_replace('00', '', $phone);

    }

    return trim($phone);
}

//Choix d'un image plus reduite a aficher en miniature
function loadImg($image){

    

    $extension_pos = strrpos($image, '.'); // find position of the last dot, so where the extension starts
     
    return substr($image, 0, $extension_pos) . '-small' . substr($image, $extension_pos);

}



function setLang()
{
	if ($_GET('lang') == 'fr') {
		$tr = new GoogleTranslate('fr');
		
	}elseif ($_GET('lang') == 'en') {
		$tr = new GoogleTranslate('fr');
	}elseif ($_GET('lang') == 'li') {
		$tr = new GoogleTranslate('li');
	}

	return back()->with('tr', $tr);
}


function getStockLevel($stock){

    if ($stock > setting('site.stock_threshold', 5)) {

        $stockLevel = '<span class="badge badge-success p-2"> En Stock </span>';

    }elseif($stock <= setting('site.stock_threshold', 5) && $stock > 0){

        $stockLevel = '<span class="badge badge-warning p-2"> Stock Critique </span>';

    }else{

         $stockLevel = '<span class="badge badge-danger p-2"> Stock Epuisé </span>';
    }

    return $stockLevel;
}

function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
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

function productImage($path)
{
    if (file_exists('storage/'.$path)) {

        $extension_pos = strrpos($path, '.');
        $small = substr($path, 0, $extension_pos) . '-small' . substr($path, $extension_pos);
        $cropped = substr($path, 0, $extension_pos) . '-cropped' . substr($path, $extension_pos);

        if (file_exists('storage/'.$small)) {
            $path = file_exists('storage/'.$small) ? asset('storage/'.$small) : asset('img/not-found.jpg');
        }elseif(file_exists('storage/'.$cropped)) {
            $path = file_exists('storage/'.$cropped) ? asset('storage/'.$cropped) : asset('img/not-found.jpg');
        }else{
            $path = file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
        }

    }

    return $path;
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function loadCart()
{
     // init
        // Panier::where('user_id', auth()->user()->id);
    // process
     if (auth()->user() ) {
            if ($found = Panier::where('user_id', auth()->user()->id) ) {
                
      
                    // return "hello";  

                    // process
                    $datas = $found->get('product_id');

                    $products = Product::find($datas)->all();

                    foreach ($products as $product) {

                        for ($i=0; $i < $product->quantity; $i++) { 
                            # code...
                            $duplicates = Cart::search( function ($cartItem, $rowId) use ($product){
                                return $cartItem->id === $product->id;
                            });

                            if ($duplicates->isNotEmpty()) {

                                 session()->flash('errors', collect(['Ce produit existe déja dans votre panier! veuillez mettre a jour la quantité pour avoir plus d\'un produit dans votre panier']));
                                  return response()->json(['success' => false], 400);
                            }

                            $images = $product->image;
                            $details = $product->details;
                           
                            $cartCreate = Cart::add($product->id, $product->name, 1, $product->price,0, compact('images','details'))->associate('App\Product');
                        }
                         
                     }
                       

                    return  back()->with(compact('datas', 'products'));   
                  
                        
                
            }
        }
}


function orderDelivery()
{
        $orders = auth()->user()->orders()->with('products')->latest()->paginate(9); //n + 1 issues
        return $orders;
}


function sendPaymentDigibox()
{
            // int
            foreach (Cart::content() as $item) {
                     $getProduct = Product::where('id',$item->model->id)->first();
            }

            $verify = User::where('email', $getProduct->email)->first();

            $phone  = $verify->phone;
            $amount = $this->getNumbers()->get('newSubtotal');

            $contents = Cart::content()->map(function ($item){
                    return 'Achat de '.$item->model->name.' sur Kalisso.com, quantite = '.$item->qty. ', price = '.presentPrice($this->getNumbers()->get('newSubtotal'));
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


function Epay($req)
{
    // init
    $acid="167";
    $key = "eb53195f1b3a37c5d4330bcac3e05b28b3926c26";
    $token = "46fd45e4160e46ab9221f481e5149ecd3c90eac6";
    $sign = md5($token . $key);
    $signature = $sign;
    $currency = "XAF";
    $datetrans = date('Y-m-d H:i:s');
    $emailId = "caviaros123@gmail.com";
    $successurl="https://kalisso.com/merci";
    $cancelurl="https://kalisso.com/erreur";


    //merge
    $data = [
        "url" => "https://epaycongo.com/payment",
        "amount" => $req->amount ?? $req['amount'],
        "signature" => $signature,
        "acid" => $acid,
        "emailId" => $emailId,
        "successurl" => $successurl,
        "cancelurl" => $cancelurl,
        "currency" => $currency,
        "Reference" => $req->Reference ?? $req->reference,
        "reference" => rand(0000000, 9999999),
    ];

    $req->merge($data);

    return $req->all();
}

// function SMS($reference, $data, $user)
// {
//       $otp = rand(1000, 9999);
//       $phone =  phoneNumber($request->phone);
//       $contents = '<#> Votre code de vérificattion est '.$otp;


//       if ($reference == 'singUp') {
//           # code...
//       } else if ($reference == 'singIn') {
//           # code...
//       } else {
//           # code...
//       }

//       return true;

// }
