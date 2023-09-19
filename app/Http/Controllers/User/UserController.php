<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repository\User\IUserRepository;

class UserController extends Controller
{
    private $_userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('welcome');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    public function settings(){
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    public function community(){
        $user = Auth::user();
        return view('community.index', compact('user'));
    }

    public function userProfile($nickname){
        $user = $this->_userRepository->searchUserByNickname($nickname);
        return view('community.user-profile', compact('user'));
    }
}
