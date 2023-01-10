<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\IFoodRepos;
use App\Contracts\IGoalRepos;
use App\Contracts\IBasalMetabolicRateRepos;

class GoalController extends Controller
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

    //Views.
    public function goalView(){

        $foods = $this->_foodRepos->allFoodsRepos();
        $goalFoods = $this->_goalRepos->goalFoodOfTheDayRepos();
        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();

        $goalCalories = 0;
        $goalCarbohydrate = 0;
        $goalProtein = 0;
        $goalTotalFat = 0;

        if($settingGoal){
            //Metas estabelecidas pelo usuário.
            $goalCalories = $settingGoal['daily_calories'];
            $goalCarbohydrate = $settingGoal['daily_carbohydrate'];
            $goalProtein = $settingGoal['daily_protein'];
            $goalTotalFat = $settingGoal['daily_fat'];
        }

        //Resultados do dia.
        $todaysCalories = $goalFoods->sum('calories');
        $todaysCarbohydrate = $goalFoods->sum('carbohydrate');
        $todaysProtein = $goalFoods->sum('protein');
        $todaysTotalFat = $goalFoods->sum('total_fat');

        return view('goal.goal', compact('goalFoods', 
                                            'settingGoal',
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

        $foods = $this->_foodRepos->allFoodsRepos();
 
        return view('goal.addFoodToGoal', compact('foods'));
    }

    public function updateFoodToDayGoalView($id){

        $food = $this->_goalRepos->findFoodRepos($id);
 
        return view('goal.updateFoodToGoal', compact('food'));
    }
    
    //Página de cálculo Taxa de Metabolismo Basal (TMB).
    public function settingGoalView(){

        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();

        return view('goal.settingGoal', compact('settingGoal'));
    }


    //Funções.
    public function addFoodToDayGoal(){
        
        $data = $this->_request->all();

        $food = $this->_goalRepos->addFoodToDayGoalRepos($data);

        return redirect()->route('goalView');
    }
    
    public function updateFoodToDayGoal($id){

        $food = $this->_goalRepos->updateFoodToDayGoalRepos($id);

        return redirect()->route('goalView');
    }

    //
    public function settingGoal(){

        $data = $this->_request->all();
        
        $settingGoal = $this->_basalMetabolicRateRepos->settingBasalMetabolicRateRepos($data);

        return view('goal.settingGoal');
    }

    public function deleteGoalFood($id){

        $deleteFoodGoal = $this->_goalRepos->deleteGoalFoodRepos($id);

        return redirect()->route('goalView');
        
    }

}
