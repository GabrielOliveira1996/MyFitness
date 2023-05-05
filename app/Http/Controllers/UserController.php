<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;

class UserController extends Controller
{

    private $_request;
    private $_userService;

    public function __construct(Request $request, UserService $userService)
    {
        //$this->middleware('auth');
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

    //Views.
    public function perfil()
    {

        $user = Auth::user();
        //$settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();

        //return view('perfil', compact('user', 'settingGoal'));
    }

    public function perfilUpdate()
    {

        $data = $this->_request->all();

        //$settingGoal = $this->_basalMetabolicRateRepos->settingBasalMetabolicRateRepos($data);

        //return redirect()->route('perfil');
    }
}
