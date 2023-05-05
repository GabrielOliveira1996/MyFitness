<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    private $_request;
    private $_userService;

    public function __construct(Request $request, UserService $userService)
    {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_userService = $userService;
    }

    public function profile()
    {
        $user = Auth::user();
        return view('perfil', compact('user'));
    }
}
