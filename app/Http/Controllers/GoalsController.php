<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalsController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');

    }

    public function myGoalsView(){

        return view('goals.myGoals');
    }

}
