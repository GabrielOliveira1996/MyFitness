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

        //$foods = $this->_foodRepos->allFoodsRepos();
        
        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();
        $date = date('d/m/Y');
        $dateToInputView = date('Y-m-d');
        //dd($date);
        //Tipos de refeição.
        $breakfastGoalFoods = $this->_goalRepos->breakfastGoalFoodsRepos($date);
        $lunchGoalFoods = $this->_goalRepos->lunchGoalFoodsRepos($date);
        $snackGoalFoods = $this->_goalRepos->snackGoalFoodsRepos($date);
        $dinnerGoalFoods = $this->_goalRepos->dinnerGoalFoodsRepos($date);
        $preWorkoutGoalFoods = $this->_goalRepos->preWorkoutGoalFoodsRepos($date);
        $postWorkoutGoalFoods = $this->_goalRepos->postWorkoutGoalFoodsRepos($date);
        
        //dd($breakfastGoalFoods);
        
        //Talvez não precise mais dessas variaveis, verificar.
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
        $todaysCalories = $breakfastGoalFoods->sum('calories') 
                            + $lunchGoalFoods->sum('calories') 
                            + $snackGoalFoods->sum('calories') 
                            + $dinnerGoalFoods->sum('calories')
                            + $preWorkoutGoalFoods->sum('calories')
                            + $postWorkoutGoalFoods->sum('calories'); 

        $todaysCarbohydrate = $breakfastGoalFoods->sum('carbohydrate') 
                                + $lunchGoalFoods->sum('carbohydrate') 
                                + $snackGoalFoods->sum('carbohydrate') 
                                + $dinnerGoalFoods->sum('carbohydrate')
                                + $preWorkoutGoalFoods->sum('carbohydrate')
                                + $postWorkoutGoalFoods->sum('carbohydrate');

        $todaysProtein = $breakfastGoalFoods->sum('protein') 
                            + $lunchGoalFoods->sum('protein') 
                            + $snackGoalFoods->sum('protein') 
                            + $dinnerGoalFoods->sum('protein')
                            + $preWorkoutGoalFoods->sum('protein')
                            + $postWorkoutGoalFoods->sum('protein');

        $todaysTotalFat = $breakfastGoalFoods->sum('total_fat') 
                            + $lunchGoalFoods->sum('total_fat') 
                            + $snackGoalFoods->sum('total_fat') 
                            + $dinnerGoalFoods->sum('total_fat')
                            + $preWorkoutGoalFoods->sum('total_fat')
                            + $postWorkoutGoalFoods->sum('total_fat');
        
        return view('goal.goal', compact('breakfastGoalFoods', 
                                            'lunchGoalFoods',
                                            'snackGoalFoods',
                                            'dinnerGoalFoods',
                                            'preWorkoutGoalFoods',
                                            'postWorkoutGoalFoods',
                                            'settingGoal',
                                            'todaysCalories', 
                                            'todaysCarbohydrate', 
                                            'todaysProtein', 
                                            'todaysTotalFat',
                                            'goalCalories',
                                            'goalCarbohydrate',
                                            'goalProtein',
                                            'goalTotalFat',
                                            'dateToInputView'
                                        ));
    }  
    
    public function addFoodToDayGoalView(){

        $foods = $this->_foodRepos->allFoodsRepos();
 
        return view('goal.addFoodToGoal');
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

    public function searchGoal(){

        $data = $this->_request->all();
        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();
        $search = $this->_goalRepos->searchGoalRepos($data);
        $explodeDate = explode('-', $this->_request->date);
        $date = $explodeDate[2].'/'.$explodeDate[1].'/'.$explodeDate[0];
        $dateToInputView = $explodeDate[0].'-'.$explodeDate[1].'-'.$explodeDate[2];
        //dd($date);
        //Tipos de refeição.
        $breakfastGoalFoods = $this->_goalRepos->breakfastGoalFoodsRepos($date);
        $lunchGoalFoods = $this->_goalRepos->lunchGoalFoodsRepos($date);
        $snackGoalFoods = $this->_goalRepos->snackGoalFoodsRepos($date);
        $dinnerGoalFoods = $this->_goalRepos->dinnerGoalFoodsRepos($date);
        $preWorkoutGoalFoods = $this->_goalRepos->preWorkoutGoalFoodsRepos($date);
        $postWorkoutGoalFoods = $this->_goalRepos->postWorkoutGoalFoodsRepos($date);

        //Talvez não precise mais dessas variaveis, verificar.
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
        $todaysCalories = $breakfastGoalFoods->sum('calories') 
                            + $lunchGoalFoods->sum('calories') 
                            + $snackGoalFoods->sum('calories') 
                            + $dinnerGoalFoods->sum('calories')
                            + $preWorkoutGoalFoods->sum('calories')
                            + $postWorkoutGoalFoods->sum('calories'); 
        
        $todaysCarbohydrate = $breakfastGoalFoods->sum('carbohydrate') 
                                + $lunchGoalFoods->sum('carbohydrate') 
                                + $snackGoalFoods->sum('carbohydrate') 
                                + $dinnerGoalFoods->sum('carbohydrate')
                                + $preWorkoutGoalFoods->sum('carbohydrate')
                                + $postWorkoutGoalFoods->sum('carbohydrate');

        $todaysProtein = $breakfastGoalFoods->sum('protein') 
                            + $lunchGoalFoods->sum('protein') 
                            + $snackGoalFoods->sum('protein') 
                            + $dinnerGoalFoods->sum('protein')
                            + $preWorkoutGoalFoods->sum('protein')
                            + $postWorkoutGoalFoods->sum('protein');

        $todaysTotalFat = $breakfastGoalFoods->sum('total_fat') 
                            + $lunchGoalFoods->sum('total_fat') 
                            + $snackGoalFoods->sum('total_fat') 
                            + $dinnerGoalFoods->sum('total_fat')
                            + $preWorkoutGoalFoods->sum('total_fat')
                            + $postWorkoutGoalFoods->sum('total_fat');

        return view('goal.goal', compact('breakfastGoalFoods', 
                                            'lunchGoalFoods',
                                            'snackGoalFoods',
                                            'dinnerGoalFoods',
                                            'preWorkoutGoalFoods',
                                            'postWorkoutGoalFoods',
                                            'settingGoal',
                                            'todaysCalories', 
                                            'todaysCarbohydrate', 
                                            'todaysProtein', 
                                            'todaysTotalFat',
                                            'goalCalories',
                                            'goalCarbohydrate',
                                            'goalProtein',
                                            'goalTotalFat',
                                            'dateToInputView'
                                        ));

    }

}
