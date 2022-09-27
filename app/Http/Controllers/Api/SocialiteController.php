<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite; 
use App\User;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = [ "google", "facebook" ];

    # La vue pour les liens vers les providers
    public function loginRegister () {
    	return view("socialite.login-register");
    }

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
            $user = User::where("email", $email)->first();

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
            if (!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                $user->avatar = $data->avatar;
                $user->save();
            }

            // dd($user);

            # 4. On connecte l'utilisateur
            // Auth::login($user);
            Auth::login($user);

            # 5. On redirige l'utilisateur vers /home
            if (Auth::check()) return redirect('/account/profile');

         }
         abort(404);
    }
}
