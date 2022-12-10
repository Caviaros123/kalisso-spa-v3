<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Socialite; 
use App\User;
use Illuminate\Http\UploadedFile;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = [ "google", "facebook" ];

    // # La vue pour les liens vers les providers
    // public function loginRegister () {
    // 	return view("socialite.login-register");
    // }

    # redirection vers le provider
    public function redirect (Request $request) {

        $provider = $request->provider;

        // On vérifie si le provider est autorisé
        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect(); // On redirige vers le provider
        }
        abort(404); // Si le provider n'est pas autorisé
    }

    // Callback du provider
    public function callback (Request $request) {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

        	// Les informations provenant du provider
            $data = Socialite::driver($request->provider)->user();

            // dd($data);

            # Social login - register
            $email = $data->getEmail(); // L'adresse email
            $name = $data->getName(); // le nom

            # 1. On récupère l'utilisateur à partir de l'adresse email
            // $user = User::where("email", $email)->first();

            # 2. Si l'utilisateur existe
            // if (isset($user)) {

            //     // Mise à jour des informations de l'utilisateur
            //     $user->name = $name;
            //     $user->save();
            //     // $login = ['email' => $email, 'password' => ''];

            // # 3. Si l'utilisateur n'existe pas, on l'enregistre
            // } else {
            //     $password = bcrypt("kalisso0000-@-".uniqid());
            //     // Enregistrement de l'utilisateur
            //     $user = User::create([
            //         'name' => $name,
            //         'email' => $email,
            //         'password' => $password// On attribue un mot de passe
            //     ]);

            //     // $login = ['email' => $email, 'password' => $password];

            // }
            $user = User::where('email', '=', $email)->first();


            $users_storage_path = 'users/'.date('FY');
            $path = storage_path('app/public/'.$users_storage_path);
            // dd($path);

            // dd($data->user);

            if (!$user) {
                if(!is_dir($path)){
                    mkdir($path, 0755, true);
                }

                $avatar_url =$data->avatar;

                $info = pathinfo($avatar_url);
                $tempImage = file_get_contents($avatar_url);
                $filename = uniqid().'.jpg';
                $new_path = $path.'/'.$filename;
                file_put_contents($new_path, $tempImage);
               

                // return response()->download($tempImage, $filename);

                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                
                // dd($dat);
                // /storage/users/December2021/vBGZDMLgn4UYv3E3KPWnducANR59ASBa9bi7tJzH.jpg"
                $user->avatar = $users_storage_path.'/'.$filename ?? $data->avatar;
                $user->email_verified_at = $data->user['email_verified'] ? NOW() : null;
                $user->registered_from = $request->provider;
                $user->password = bcrypt("kalisso0000-@-".uniqid());
                $user->save();
            }


            // $user->createToken($request->get('device_name') ?? $data->id)->accessToken;

            // dd($user);

            # 4. On connecte l'utilisateur
            // Auth::login($user);
            Auth::login($user);

            // dd(Auth::user());

            # 5. On redirige l'utilisateur vers /home
            if (Auth::check())  return redirect('/login?callback='.$request->provider.'&login=1');

         }
         abort(404);
    }
}
