<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Services\UserService;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    private $_request;
    private $_userService;

    public function __construct(Request $request, UserService $userService)
    {
        $this->middleware('guest');
        $this->_request = $request;
        $this->_userService = $userService;
    }

    public function register()
    {
        $user = $this->_request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);
        $register = $this->_userService->register($user);
        return redirect()->route('home');
    }
}
