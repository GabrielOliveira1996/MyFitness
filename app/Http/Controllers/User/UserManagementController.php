<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserManagementController extends Controller
{
    private $_request;
    private $_userService;

    public function __construct(Request $request, UserService $userService)
    {
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
        $this->middleware('auth');
        Auth::logout();
        $this->_request->session()->invalidate();
        $this->_request->session()->regenerateToken();
        return redirect('/');
    }

    public function updateProfile()
    {
        $this->middleware('auth');
        $user = $this->_request->only([
            'gender',
            'age',
            'weight',
            'stature',
            'activity_rate_factor',
            'objective',
            'type_of_diet',
            'imc',
            'water',
            'basal_metabolic_rate',
            'daily_calories',
            'daily_protein',
            'daily_carbohydrate',
            'daily_fat',
            'daily_protein_kcal',
            'daily_carbohydrate_kcal',
            'daily_fat_kcal'
        ]);
        $update = $this->_userService->update($user);
        return redirect()->route('profile');
    }
}
