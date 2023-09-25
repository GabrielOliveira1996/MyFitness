<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\User\IUserRepository;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    private $_socialite;
    private $_userRepository;

    public function __construct(Socialite $socialite, IUserRepository $userRepository){
        $this->_socialite = $socialite;
        $this->_userRepository = $userRepository;
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        try{
            $user = Socialite::driver('google')->user(); 
            $email = $user['email'];
            $findGoogleUser = $this->_userRepository->findUserByEmail($email);
            // Se email não existir. Criado novo usuário com google_id e entra.
            if ($findGoogleUser == null) {  
                $user = [
                    'name' => $user['given_name'],
                    'email' => $user['email'],
                    'password' => $user['id'],
                    'google_id' => $user['id']
                ];
                $newUser = $this->_userRepository->createGoogleUser($user);
                $auth = Auth::login($newUser);
                return redirect()->route('welcome');
            }
            // Se email existir com google_id ele entra.
            if($findGoogleUser['google_id']){ 
                $auth = Auth::login($findGoogleUser);
                return redirect()->route('welcome');
            }
            // Se email existir, e não for google_id.
            throw new \Exception('O e-mail já está cadatrado no sistema.', 422);
        }catch(\Exception $e){
            return redirect()->route('login')->withErrors(['email' => $e->getMessage()]);
        }
    }
}
