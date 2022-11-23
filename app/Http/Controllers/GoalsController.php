<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\IFoodRepos;
use App\Contracts\IGoalRepos;

class GoalsController extends Controller
{
    
    private $_request;
    private $_foodRepos;
    private $_goalRepos;

    public function __construct(Request $request, IFoodRepos $foodRepos, IGoalRepos $goalRepos){

        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodRepos = $foodRepos;
        $this->_goalRepos = $goalRepos;
    }

    public function myGoalsView(){

        $foods = $this->_foodRepos->allFoodRepos();
        $goalFoods = $this->_goalRepos->goalFoodOfTheDay();
 
        return view('goals.myGoals', compact('goalFoods'));
    }  
    
    public function addFoodToDayGoalView(){

        $foods = $this->_foodRepos->allFoodRepos();
 
        return view('goals.addFoodToGoal', compact('foods'));
    }

    public function addFoodToDayGoal(){
        
        $data = $this->_request->all();

        $food = $this->_goalRepos->addFoodToDayGoalRepos($data);

        return redirect()->route('myGoalsView');
    }

}
