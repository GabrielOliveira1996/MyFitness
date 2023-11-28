<?php

namespace App\Http\Controllers\Diet;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DietController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('diet.index');
    }
}
