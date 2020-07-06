<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->stateless()->user(); 
        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) { 
            return $this->authAndRedirect($user); // Login y redirección
        } else {  
            switch ($provider) {
                case 'google':
                    $user = User::create([
                        'name' => $social_user->user['given_name'],
                        'lastname'=>$social_user->user['family_name'],
                        'email' => $social_user->email,
                        'avatar' => $social_user->avatar,
                    ]); 
                    $user->assignRole('consumidor');
                    break;
                case 'facebook':
                    $user = User::create([
                        'name' => $social_user->name,
                        'lastname'=>$social_user->name,
                        'email' => $social_user->email,
                        'avatar' => $social_user->avatar,
                    ]); 
                    $user->assignRole('consumidor');
                    break;
            }
            // En caso de que no exista creamos un nuevo usuario con sus datos.

            return $this->authAndRedirect($user); // Login y redirección
        }
    }
    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);
        return redirect()->to('/home');
    }
}