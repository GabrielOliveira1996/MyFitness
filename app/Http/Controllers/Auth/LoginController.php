<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    private $_request;

    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
        $this->_request = $request;
    }

    public function login()
    {
        $user = $this->_request->only('email', 'password');
        if (Auth::attempt($user)) {
            return redirect()->intended('/home');
        }
        return redirect()->back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function logout()
    {
        Auth::logout();
        $this->_request->session()->invalidate();
        $this->_request->session()->regenerateToken();
        return redirect('/');
    }
}
