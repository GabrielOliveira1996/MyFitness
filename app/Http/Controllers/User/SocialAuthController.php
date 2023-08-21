<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\User\IUserRepository;
use App\Services\UserService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAuthController extends Controller
{
    private $_request;
    private $_userService;
    private $_socialite;
    private $_userRepository;

    public function __construct(
        Request $request,
        UserService $userService,
        Socialite $socialite,
        IUserRepository $userRepository
    ) {
        $this->_request = $request;
        $this->_socialite = $socialite;
        $this->_userService = $userService;
        $this->_userRepository = $userRepository;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user(); 
        $email = $user['email'];
        $findGoogleUser = $this->_userRepository->findUserByEmail($email);
        if ($findGoogleUser == null) {  // Se email não existir. Criado novo usuário com google_id e entra.
            $user = [
                'name' => $user['given_name'],
                'email' => $user['email'],
                'password' => $user['id'],
                'google_id' => $user['id']
            ];
            $newUser = $this->_userRepository->createGoogleUser($user);
            Auth::login($newUser);
            return redirect()->route('welcome');
        }
        if($findGoogleUser['google_id']){ // Se email existir com google_id ele entra.
            Auth::login($findGoogleUser);
            return redirect()->route('welcome');
        }
        // Se email existir, e não for google_id.
        return redirect()->route('login')->withErrors(['email' => 'O e-mail já está cadatrado no sistema.']);
    }
}
