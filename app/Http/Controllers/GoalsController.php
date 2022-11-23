<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\IFoodRepos;
use App\Contracts\IGoalRepos;
use App\Contracts\IBasalMetabolicRateRepos;

class GoalsController extends Controller
{
    
    private $_request;
    private $_foodRepos;
    private $_goalRepos;
    private $_basalMetabolicRateRepos;

    public function __construct(Request $request, IFoodRepos $foodRepos, IGoalRepos $goalRepos, IBasalMetabolicRateRepos $basalMetabolicRateRepos){

        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodRepos = $foodRepos;
        $this->_goalRepos = $goalRepos;
        $this->_basalMetabolicRateRepos = $basalMetabolicRateRepos;
    }

    public function myGoalsView(){

        $foods = $this->_foodRepos->allFoodRepos();
        $goalFoods = $this->_goalRepos->goalFoodOfTheDayRepos();
        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();
        
        //Metas estabelecidas pelo usuário.
        $goalCalories = $settingGoal['basal_metabolic_rate'];
        $goalCarbohydrate = $settingGoal['daily_protein'];
        $goalProtein = $settingGoal['daily_carbohydrate'];
        $goalTotalFat = $settingGoal['daily_fat'];

        //Resultados do dia.
        $todaysCalories = $goalFoods->sum('calories');
        $todaysCarbohydrate = $goalFoods->sum('carbohydrate');
        $todaysProtein = $goalFoods->sum('protein');
        $todaysTotalFat = $goalFoods->sum('total_fat');

        return view('goals.myGoals', compact('goalFoods', 
                                            'todaysCalories', 
                                            'todaysCarbohydrate', 
                                            'todaysProtein', 
                                            'todaysTotalFat',
                                            'goalCalories',
                                            'goalCarbohydrate',
                                            'goalProtein',
                                            'goalTotalFat'
                                        ));
    }  
    
    public function addFoodToDayGoalView(){

        $foods = $this->_foodRepos->allFoodRepos();
 
        return view('goals.addFoodToGoal', compact('foods'));
    }

    //Página de cálculo Taxa de Metabolismo Basal (TMB).
    public function settingGoalsView(){

        return view('goals.settingGoals');
    }

    public function settingGoals(){

        $data = $this->_request->all();
        
        $settingGoal = $this->_basalMetabolicRateRepos->settingBasalMetabolicRateRepos($data);

        return view('goals.settingGoals');
    }

    public function addFoodToDayGoal(){
        
        $data = $this->_request->all();

        $food = $this->_goalRepos->addFoodToDayGoalRepos($data);

        return redirect()->route('myGoalsView');
    }

}
