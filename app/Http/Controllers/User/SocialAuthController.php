<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\User\IUserRepository;
use App\Services\UserService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

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
        $findGoogleUser = $this->_userRepository->findGoogleUser($user['id']);
        if ($findGoogleUser) {
            Auth::login($findGoogleUser);
            return view('welcome');
        } else {
            $user = [
                'name' => $user['given_name'],
                'email' => $user['email'],
                'password' => $user['id'],
                'google_id' => $user['id']
            ];
            $newUser = $this->_userRepository->create($user);
            Auth::login($newUser);
            return view('welcome');
        }
        return view('welcome');
    }
}
