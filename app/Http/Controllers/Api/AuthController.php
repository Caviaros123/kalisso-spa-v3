<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
  protected $providers = ["google", "facebook"];
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
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
      'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
    ]);

    $user = auth()->user();
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
  public function loginWithSocial(Request $request)
  {

    $request->validate([
      'source' => 'required|string|string|max:3|min:3',
      'type' => 'required|string',
      'userData' => 'required',
    ]);

    $provider = $request->type;

    if (in_array($provider, $this->providers)) {

      // Les informations provenant du provider
      $data = $request->get('userData');

      $id = $data['id']; // L'adresse email
      $email = $data['email']; // L'adresse email
      $name = $data['name']; // le nom
      $avatar = $data['avatar']; // le nom
      // return $email;
      # Social login - register

      $user = User::where('email', '=', $email)->first();


      if (!$user) {
        $users_storage_path = 'users/' . date('FY');
        $path = storage_path('app/public/' . $users_storage_path);

        if (!is_dir($path)) {
          mkdir($path, 0755, true);
        }

        $avatar_url = $avatar;

        $info = pathinfo($avatar_url);
        $tempImage = file_get_contents($avatar_url);
        $filename = uniqid() . '.jpg';
        $new_path = $path . '/' . $filename;
        file_put_contents($new_path, $tempImage);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->provider_id = $id;

        $user->avatar = $users_storage_path . '/' . $filename ?? $avatar;
        $user->email_verified_at = NOW();
        $user->registered_from = $provider;
        $user->password = bcrypt("kalisso0000-@-" . uniqid());
        $user->save();
      }
      //token generate
      $getToken = $user->createToken($request->get('device_name') ?? 'device_name');
      $token['token'] = $getToken->plainTextToken;

      # 4. On connecte l'utilisateur
      Auth::login($user);

      # 5. On redirige l'utilisateur vers /home
      if (Auth::check()) {
        return response()->json([
          'success' => true,
          'token' => $token,
          'user' => $user,
          'data' => $user
        ], 200);
      }
    }

    return response()->json([
      'success' => false,
      'data' => []
    ], 404);
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
    } else {
      return response()->json([
        'success' => false,
        'message' => 'Unable to Logout'
      ]);
    }
  }

  public function products()
  {

    # code...
    $products = Product::allProducts();

    $this->response['message'] = 'success';
    $this->response['data'] = $products;

    return response()->json($this->response, 200);
  }
  public function getCurrentUser()
  {

    # code...
    $user =  Auth::user();

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

  public function forgotPassword(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    return response()->json([
      'success' => true,
      'message' => 'Logout successfully',
      'data' => $status
    ]);
  }

  public function resetPassord(Request $request)
  {
    $request->validate(['token' => 'required|string']);
  }
}
