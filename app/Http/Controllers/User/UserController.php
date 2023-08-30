<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
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
}
