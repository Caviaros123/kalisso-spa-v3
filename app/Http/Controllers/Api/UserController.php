<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Events\SmsNotify;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Profile;
use App\Models\User;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Composer\Util\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\GetLastSeen;
use App\Http\Resources\GetAddress;
use App\Http\Resources\GetOrderList;
use Illuminate\Support\Facades\DB;
use Image;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function getOrderList(Request $request)
    {
        if (Auth::user()) {

            $orders = Auth::user()->orders()->with('products')->latest()->skip($request->skip)->limit($request->limit)->get();

            return response()->json([
                'success' => true,
                'message' => 'Voici vos commandes',
                'data' => GetOrderList::collection($orders)
            ], 200);
        }
    }

    public function saveSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Echec de validation de la recherche'
            ], 400);
        }

        try {

            $checkExistSearch = DB::table('tbl_search')->where('user_id', Auth::id())->where('search_word',  $request->search)->first();

            if ($checkExistSearch) {
                return response()->json([
                    'success' => false,
                    'message' => 'La recherche exsite deja',
                    'data' => $checkExistSearch
                ], 400);
            } else {

                DB::table('tbl_search')->insert([
                    'user_id' => Auth::id(),
                    'search_word' => $request->search,
                    'search_date' => NOW()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Recherche enregistrer'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }


    public function updatePictureProfile(Request $request)
    {
        $path = public_path() . '/storage/users/' . date('FY');

        // return $path;

        if (!is_dir($path)) {
            $path = mkdir($path, 0755, true);
        } else{
            $path = $path;
        }
        
        $request->validate([
            'image'   => 'present|required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);

        if($request->hasFile('image')) {

            try {

                $chemin = $request->file('image')->store('users/'. date('FY'));

                $id = Auth::user()->id;
                $user = User::find($id);
                $user->avatar = $chemin;
                $user->save();

                if($user != null){
                    return response()->json([
                        'success' => true,
                        'message' => 'Votre photo de profile a bien été mise à jour',
                        'data' => $user
                    ], 200);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Echec'
                    ], 400);
                }

            } catch (ServerException $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e
                ], 400);
            }
        }
        
    }

    public function getUserStore(Request $request)
    {
        // init
        $getSessionId = '';
        $user =  '';
        $store = '';
        $uid = '';
        $skip  = $request->skip;
        $limit = $request->limit;
        $products = '';
        $product = [];
        $getProductId = '';
        $data = [];
        $order = [];


        $getSessionId = DB::table('tbl_session')->first();
        $user =  Auth::user();
        $store = DB::table('profiles')->where('email', $user->email)->first();
        $uid = Auth::id();

        if (request()->has('skip') && request()->has('limit')) {
            $products = Product::where('store_id', $store->store_id)->orderBy('id', 'desc')->skip($request->skip)->limit($request->limit)->get();
        } else {
            $products = Product::where('store_id', $store->store_id)->orderBy('id', 'desc')->get();
        }

        $getProductId = Product::where('store_id', $store->store_id)->orderBy('id', 'desc')->get('id');

        foreach ($getProductId as $key => $value) {

            $data[] = $value['id'];
        }

        $product_ordering = OrderProduct::whereIn('product_id', $data)->get();
        $product_ordering_id = OrderProduct::whereIn('product_id', $data)->get('product_id');

        foreach ($product_ordering as $key => $value) {

            $order[] = $value['order_id'];
        }

        $orders = Order::whereIn('id', $order)->orderBy('id', 'desc')->get();

        $products_order = Product::whereIn('id', $product_ordering_id)->orderBy('id', 'desc')->get();

        foreach ($products_order as $p => $vp) {
            foreach ($orders as  $o => $vo) {
                $rsData[$o]['id'] = (int) $vo['id'];
                $rsData[$o]['invoice'] = $vo['transaction_id'];
                $rsData[$o]['date'] = date('j F Y', strtotime($vo['created_at']));
                $rsData[$o]['status'] = $vo['paymentStatus'];
                $rsData[$o]['name'] = $vp['name'];
                $rsData[$o]['image'] = "https://kalisso.com/storage/" . $vp['image'];
                $rsData[$o]['payment'] = (float) $vo['billing_total'];
            }
        }

        // code...
        foreach ($products as $key => $value) {
            $product[$key]["id"] = (int) $value['id'];
            $product[$key]["name"] = $value['name'];
            $product[$key]["price"] = (float) $value['price'];
            $product[$key]["image"] = "https://kalisso.com/storage/" . $value['image'];
            $product[$key]["rating"] = (float) $value['rating'] ?? 0;
            $product[$key]["review"] = (int) $value['review'] ?? 0;
            $product[$key]["sale"] = (int) $value['product_sale'] ?? 0;
            $product[$key]["location"] = $value['location'];
        }

        $data = array(
            'store' => $store,
            'orders' => $rsData ?? [],
            'orders_products' => $products_order,
            'products' => $product
        );

        try {

            if ($request->get('session_id') == $getSessionId->session_id) {
                if ($store != null) {
                    return response()->json([
                        "status" => 200,
                        "msg" => "Success",
                        "data" => $data
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'aucune boutique trouver',
                        "data" => []
                    ], 404);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'false',
                    'data' => $request,
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Echec',
                "data" => $e
            ], 404);
        }
    }

    public function addProductLastSeen(Request $request)
    {
        $request->merge([
            'user_id' => Auth::id(),
        ]);

        $request->validate([
            'product_id'   => 'present|required|numeric',
            'user_id'      => 'present|required|numeric',
        ]);

        $duplicated = DB::table('tbl_last_seen')
            ->where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($duplicated != null) {
            $data = DB::table('tbl_last_seen')->insert([
                'user_id'          => Auth::id(),
                'product_id' => $request->product_id,
                'last_seen_create_date'  => NOW()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Nouveau produit vu récement',
                'data' => $data
            ], 201);

        } else {
            return response()->json([
                'status' => 404,
                'message' => 'false',
                'data' => '',
            ]);
        }
    }


    public function getDefaultAddress(Request $request)
    {
        // init;
        $id = Auth::id();
        $dataAddress = DB::table('tbl_address')->where('user_id', $id)->where('default_address', 1)->first();

        if ($dataAddress != null) {
            return response()->json([
                'status' => 200,
                'msg' => 'success',
                'data' => $dataAddress
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => 'false',
                'data' => []
            ]);
        }
    }

    public function deleteAddress(Request $request)
    {
        // init
        $getSessionId = DB::table('tbl_session')->first();
        $uid = Auth::id();


        $validator = Validator::make($request->all(), [
            'id'     => 'required|numeric',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Echec de validation'
            ], 400);
        }

        $exist = DB::table('tbl_address')
            ->where('user_id', $uid)
            ->where('id', $request->id)
            ->first();

        if ($exist != null) {

            DB::table('tbl_address')->where('id', $request->id)->where('user_id', Auth::id())->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vous avez supprimer une adresse de livraison'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => 'false',
            ]);
        }
    }

    public function setDefaultAddress(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        DB::table('tbl_address')->where('user_id', Auth::id())->update([
            'default_address' => false
        ]);

        $updateAddress = DB::table('tbl_address')
        ->where('id', $request->id)
        ->where('user_id', Auth::id())
        ->update([
            'default_address' => true
        ]);

        if($updateAddress){
            return response()->json([
                'success' => true,
                'message' => 'Vous avez changer votre adresse par défaut',
                'data' => $updateAddress
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Echec lors du changement de l\'adresse'
            ], 400);
        }   
    }

    public function editAddress(Request $request)
    {
        // init
        $getSessionId = DB::table('tbl_session')->first();
        $uid = Auth::id();


        $validator = Validator::make($request->all(), [
            'id'               => 'required|numeric',
            'title'            => 'required|string',
            'recipient_name'   => 'required|string',
            'phone_number'     => 'required|numeric',
            'address_line1'    => 'required|string',
            'address_line2'    => 'required|string',
            'country'          => 'required|string',
            'state'            => 'required|string',
            'default_address'  => 'required|boolean'

        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Echec de validation'
            ], 400);
        }

        $checkDefault = DB::table('tbl_address')
            ->where('default_address', 1)
            ->first();

        if ($request->changeDefaultAddress) {
        }


        $check = DB::table('tbl_address')
            ->where('user_id', Auth::id())
            ->where('id', $request->id)
            ->first();



        if ($check != null && $request->get('session_id') == $getSessionId->session_id) {


            DB::table('tbl_address')
                ->where('user_id', Auth::id())
                ->where('id', $request->id)
                ->update([
                    'user_id'          => Auth::id(),
                    'title'            => $request->title,
                    'recipient_name'   => $request->recipient_name,
                    'phone_number'     => $request->phone_number,
                    'address_line1'    => $request->address_line1,
                    'address_line2'    => $request->address_line2,
                    'state'            => $request->state,
                    'country'          => $request->country,
                    'default_address'  => $request->default_address,
                    'updated_at'  => NOW()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Vous avez modifier une adresse de livraison'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Echec de modification de l\'adresse'
            ]);
        }
    }


    
    public function addAddress(Request $request)
    {
        // init
        $uid = Auth::id();
        $getSessionId = DB::table('tbl_session')->first();

        $request->validate([
            'title'            => 'present|required|string:unique',
            'recipient_name'   => 'present|required|string',
            'phone_number'     => 'present|required|numeric',
            'address_line1'    => 'present|required|string',
            'address_line2'    => 'present|required|string',
            'country'          => 'present|required|string',
            'state'            => 'present|required|string',
            'default_address'  => 'present|required|boolean'
        ]);

        $request->merge([
            'title' => '#'.rand(100000, 999999),
            'phone' => phoneNumber($request->phone_number)
        ]);

        if ($request->default_address == 1) {
            DB::table('tbl_session')->where('user_id', $uid)->where('default_address', 1)->update([
                'default_address' => false
            ]);
        }

        $duplicated = DB::table('tbl_address')
            ->where('user_id',  $uid)
            ->where('title', $request->title)
            ->first();

        if ($duplicated != null) {
            return response()->json([
                'success' => true,
                'message' => 'Cette adresse existe déjà'
            ], 405);
        }

        if ($request->get('session_id') == $getSessionId->session_id) {
            $data = DB::table('tbl_address')->insert([
                'user_id'          => $uid,
                'title'            => $request->title,
                'recipient_name'   => $request->recipient_name,
                'phone_number'     => $request->phone_number,
                'address_line1'    => $request->address_line1,
                'address_line2'    => $request->address_line2,
                'state'            => $request->state,
                'country'          => $request->country,
                'default_address'  => $request->default_address,
                'created_at'  => NOW(),
                'updated_at'  => NOW()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vous avez ajouter une nouvelle adresse de livraison',
                'data' => $data
            ], 201);
        } else {
            return response()->json([
                'success' => 404,
                'msg' => 'false',
                'data' => '',
            ], 404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
  
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $orders = Auth::user()->orders()->with('products')->latest()->get(); //n + 1 issues

        return view('mon-compte', compact('orders'))->with('user',  Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([ 
            'name' =>  'string', 'max:255',
            'lastname' =>  'string', 'max:255',
            'avatar' =>  'string', 'max:255',
            'phone' =>  'number', 'max:15', 'unique:users,phone',
            'city' =>  'string', 'max:255',
            'country' =>  'string', 'max:255',
            'email' =>  'string', 'email', 'max:255', 'unique:users,email,'.Auth::id(),
            'password' => 'sometimes', 'nullable', 'string', 'min:8', 'confirmed',
        ]);

        $user =  Auth::user();
        $input = $request->except('password', 'password_confirmation');

        if (!$request->filled('password')) {

            $user->fill($input)->save();

            return back()->with('success_message', 'Le profile a bien été mise à jour');
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('success_message', 'Le profile et le mot de passe ont bien été mise à jour');
    }

    // API LOGIN
    public function login(Request $request)
    {

        $login = $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if (is_numeric($request->get('email'))) {
            $login = ['phone' => $request->get('email'), 'password' => $request->get('password')];
        } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $login = ['email' => $request->get('email'), 'password' => $request->get('password')];
        }

        // return $request->all();

        if (Auth::attempt($login)) {

            $user = Auth::user();
            // $token = $user->createToken(request('device_name'));
 
            // return ['token' => $token->plainTextToken];

            $success['token'] = $user->createToken('token-name', ['server:update'])->plainTextToken;
            //After successfull authentication, notice how I return json parameters
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user,
                'data' => $user
            ], 200);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Echec vérifier vos identifiants',
                'user' => [],
                'data' => []
            ], 401);
        }
    }

    public function loginWithOtp(Request $request)
    {
        $user = User::where([['phone', '=', request('phone')]])->first();

        if ($user) {

            Auth::login($user, true);
            $user = Auth::user();
            $success['token'] = $user->createToken(request('device_name'))->accessToken;
            //User::where('phone','=', $request->phone)->update(['otp' => null]);

            DB::table('users')->where('id', Auth::id())->update([
                'phone_verified_at' => NOW(),
                'otp' => null
            ]);

            //After successfull authentication, notice how I return json parameters
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
            ]);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Invalid Otp or Phone',
            ], 401);
        }
    }

    public function sendOtp(Request $request)
    {

        $otp = rand(100000, 999999);
        $phone =  phoneNumber($request->phone);
        $contents = '<#> Kalisso.com: Votre code de vérificattion est ' . $otp;
        $user =  User::where('phone', $phone)->update([
            'otp' => $otp
        ]);
        if ($request->status == 'signUpWithEmail') {
            return response()->json([
                'success' => true,
                'user' => $otp
            ], 200);
        } elseif ($request->status == 'signUpWithPhone' && $user == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur introuvable'
            ]);
        } elseif ($user == 0 && $request->status == 'register') {
            try {
                // $sms = array(
                //     'client'=>    'caviaros123',
                //     'password'=>    'FilsdeDieu1995@',
                //         'phone'=>    $phone,// The number that will receive the text message
                //         'from'=>    'Kalisso.com',// The sender of the SMS
                //         'affiliate' => '999',
                //         'text' => utf8_decode(urldecode($contents)), // The content of the text message
                //     );

                // $context = stream_context_create(array(
                //     'http' => array(
                //       'method' => 'POST',
                //       'header'  => "Content-type: application/x-www-form-urlencoded",
                //       'content' => http_build_query($sms),
                //   )));

                // $response = file_get_contents("https://api.wirepick.com/httpsms/send", false, $context);

                return response()->json([
                    'success' => true,
                    'user' => $otp
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Send verification code',
                ], 401);
            }
        } else if ($user == 1 && $request->status == 'login') {
            try {
                // $sms = array(
                //   'client'=>    'caviaros123',
                //   'password'=>    'FilsdeDieu1995@',
                //       'phone'=>    $phone,// The number that will receive the text message
                //       'from'=>    'Kalisso.com',// The sender of the SMS
                //       'affiliate' => '999',
                //       'text' => utf8_decode(urldecode($contents)), // The content of the text message
                //   );

                // $context = stream_context_create(array(
                //   'http' => array(
                //     'method' => 'POST',
                //     'header'  => "Content-type: application/x-www-form-urlencoded",
                //     'content' => http_build_query($sms),
                // )));

                // $response = file_get_contents("https://api.wirepick.com/httpsms/send", false, $context);

                return response()->json([
                    'success' => true,
                    'user' => $otp
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'success' => false,
                    'message' => 'failed to found this phone'
                ]);
            }
        }
    }

    public function checkUser(Request $request)
    {
        $otp = rand(100000, 999999);
        $user = '';

        $request->validate([
            'phone' => 'numeric|required_without:email|min:9',
            'email' => 'email|required_without:phone',
            'status'=> 'present|required'
        ]);

        $request->merge(['phone' => phoneNumber($request->phone)]);
        
        if ($request->status == 'signUpWithEmail') {
            $user = User::where('email', $request->email)->first();
        } else if ($request->status == 'signUpWithPhone') {
            $user = User::where('phone', $request->phone)->first();
        }

        if ($user != null) {
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'user' => $user,
                'otp' => $otp ?? ''
            ], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cet utilisateur n\'existe pas',
            ], 200);
        }
    }

    /**
     * Register api.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //init
        $success = [];

        $request->merge([
            'phone' => phoneNumber($request->phone),
            'name' => $request->firstname,
        ]);

        $request->validate([
            'email' => 'email|unique:users,email',
            'lastname' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|string|min:8|confirmed', // regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            'isSeller' => 'boolean',
            'terms' => 'required|boolean:true',
        ], [
            'email.unique' => 'Cette email est déja utilisé',
            'email.string' => 'L\'email ne peut pas être vide',
            'phone.unique' => 'Ce numéro de téléphone est déja utilisé',
            'phone.numeric' => 'Veuillez saisir un numéro valide',
            'phone.min' => 'Le numéro de téléphone est trop court',
            'password.string' => 'Ce champ ne peut être vide',
            'password.min' => 'Le mot de passe est trop court',
            'password.confirmed' => 'Les mot de passe ne sont pas identiques',
        ]);

        // init
        // $otp = rand(100000, 999999);

        // $request->merge([
        //     'otp' => $otp
        // ]);
        
        if ($request->status == 'registerWithPhone') {

            try {
                $input = $request->all();
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                $success['token'] = $user->createToken('appToken')->accessToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Félicitations vous êtes inscrit sur la plus grande\n plateforme de vente en ligne au Congo-Brazzaville',
                    'token' => $success,
                    'data' => $user
                ]);
            } catch (ServerException $e) {
                return $e;
            }
        } elseif ($request->status == 'signUpWithEmail') {

            // $request->merge([
            //     'otp' => $otp

            // ]);

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('appToken')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
            ]);
        }

        // return response()->json($request->all(), 200);
    }

    // logout
    public function logout()
    {

        $user = Auth::user();

        if ($user) {
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Can\'t Logout'
            ]);
        }
    }


    public function products()
    {
        $products = Product::all();
        $this->response['message'] = 'success';
        $this->response['data'] = $products;

        return response()->json($this->response, 200);
    }


    public function getCurrentUser(Request $request)
    {
        
        // return dd($request);

        # code...
        $user =  Auth::user();
        $productWishlist = [];
        $orders = $user->orders()->with('products')->latest()->get();
        $wishlist = $user->likes()->where('liked', 1)->get();

        foreach ($wishlist as $ke => $value) {
            $data[$ke] = $value['product_id'];
        }

        foreach ($wishlist as $key => $value) {
            foreach (Product::whereIn('id', $data)->get() as $k => $product) {
                $productWishlist[$k] = $product;
            }
        }

        // foreach ($orders as $orderProduct => $v) {
        //     $prod[$orderProduct] = $v->products;
            
        //     foreach ($prod as $k => $val) {
        //         $order[$k] = $val->pluck(['email']);
        //     }
            
        // }
    
        // $product = nestedToSingle($order);

        // return $order;

        // foreach($product as $n){
        //     foreach (Profile::whereIn('email', $n)->get() as $kk => $v) {
        //         $ordersProductSeller[$kk] = $v;
        //     }
        // }
        
        // return $order;
        // return $ordersProductSeller;

        // $orders->push([
        //     'seller' => $ordering
        // ]);

        $defaultAddress = DB::table('tbl_address')
            ->where('user_id',  Auth::id())
            ->where('default_address', 1)
            ->first();

        $totalAddress = DB::table('tbl_address')
            ->where('user_id',  Auth::id())
            ->orderByDesc('default_address')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'User information',
            'data' => $user,
            'orders' => $orders,
            'wishlist' => $productWishlist,
            'address' => $defaultAddress,
            'totalAddress' => $totalAddress
        ]);
    }

    public function categories()
    {

        # code...
        $products = Category::all();

        $this->response['message'] = 'success';
        $this->response['data'] = $products;

        return response()->json($this->response, 200);
    }
}
