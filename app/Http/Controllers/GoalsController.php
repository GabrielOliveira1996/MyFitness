<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\IFoodRepos;

class GoalsController extends Controller
{
    
    private $_request;
    private $_foodRepos;

    public function __construct(Request $request, IFoodRepos $foodRepos){

        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodRepos = $foodRepos;
    }

    public function myGoalsView(){

        $foods = $this->_foodRepos->allFoodRepos();

        return view('goals.myGoals', compact('foods'));
    }

}
