<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    /**
     * Show the form for editing the specified resource.
     *
  
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $orders = auth()->user()->orders()->with('products')->latest()->get(); //n + 1 issues

        return view('mon-compte', compact('orders'))->with('user', auth()->user());
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
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->id()],  
            'password' => ['sometimes','nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $input = $request->except('password', 'password_confirmation');

        if (! $request->filled('password')) {
            
            $user->fill($input)->save();

            return back()->with('success_message','Le profile a bien été mise à jour');
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('success_message','Le profile et le mot de passe ont bien été mise à jour');
        

    }


    // API LOGIN
    public function login()
    {
        
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                
                  $user = Auth::user();
                  $success['token'] = $user->createToken(request('device_name'))->accessToken;
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
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    public function loginWithOtp(Request $request)
    {
      $user = User::where([['phone','=', request('phone')],['otp','=', request('otp')]])->first();

      if ( $user) {
                
              Auth::login($user, true);
              $user = Auth::user();
              $success['token'] = $user->createToken(request('device_name'))->accessToken;
              User::where('phone','=', $request->phone)->update(['otp' => null]);
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
                'message' => 'Invalid Email or Password',
            ], 401);
  
      }
    }

    public function sendOtp(Request $request)
    {
      $otp = rand(1000, 9999);
      $phone = phoneNumber($request->phone);
      $contents = 'Votre code de vérificattion est: '.$otp;

      $user =  User::where('phone','=',$phone)->update([
        'otp' => $otp
      ]);

       try {
            $sms = array(
              'client'=>    'caviaros123',
              'password'=>    'FilsdeDieu1995@',
              'phone'=>    $phone,// The number that will receive the text message
              'from'=>    'Kalisso.com',// The sender of the SMS
              'affiliate' => '999',
              'text' => utf8_decode(urldecode($contents)), // The content of the text message
            );

            $context = stream_context_create(array(
              'http' => array(
                'method' => 'POST',
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'content' => http_build_query($sms),
            )));

            $response = file_get_contents("https://api.wirepick.com/httpsms/send", false, $context);
            
           return response()->json([
                  'success' => true,
                  'user' => $user
              ]);

          } catch (\Throwable $th) {
               return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password '.$th,
            ], 401);
          }

      

    }



    /**
     * Register api.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
          return response()->json([
            'success' => false,
            'message' => $validator->errors(),
          ], 401);
        }
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


    // logout
    public function logout(Request $res)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }

    public function products()
    {
        
          # code...
          $products = Product::all();
  
          $this->response['message'] = 'success';
          $this->response['data'] = $products;
  
          return response()->json($this->response, 200);
       
    }
     public function getCurrentUser()
    {
         
          # code...
          $user =  auth('api')->user();
  
          $this->response['message'] = 'success';
          $this->response['data'] = $user;
  
          return response()->json($this->response, 200);
       
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
