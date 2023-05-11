<?php

namespace App\Http\Controllers\Goal;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\FoodService;
use App\Services\GoalService;
use App\Http\Controllers\Controller;

class GoalController extends Controller
{
    private $_request;
    private $_userService;
    private $_foodService;
    private $_goalService;

    public function __construct(
        Request $request,
        UserService $userService,
        FoodService $foodService,
        GoalService $goalService
    ) {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_userService = $userService;
        $this->_foodService = $foodService;
        $this->_goalService = $goalService;
    }

    public function index()
    {
        // Método localiza os alimento, em seguida 
        // separa em tipos, sendo eles breakfast, 
        // lunch, snack, dinner, pre workout e post
        // workout, em seguida faz calculos para 
        // somar cada calorias, carboidratos, proteinas
        // e gorduras, esses valores são passados para 
        // a view.
        $date = date('Y-m-d');
        //dd($date);
        $userGoals = $this->_userService->findUserGoals($date);

        return view('goal.index', [
            'date' => $userGoals['date'],
            'user' => $userGoals['user'],
            'breakfasts' => $userGoals['breakfast'],
            'lunchs' => $userGoals['lunch'],
            'snacks' => $userGoals['snack'],
            'dinners' => $userGoals['dinner'],
            'preWorkouts' => $userGoals['preWorkout'],
            'postWorkouts' => $userGoals['postWorkout'],
            'goalCalories' => $userGoals['goalCalories'],
            'goalCarbohydrate' => $userGoals['goalCarbohydrate'],
            'goalProtein' => $userGoals['goalProtein'],
            'goalTotalFat' => $userGoals['goalTotalFat'],
            'caloriesOfTheDay' => $userGoals['caloriesOfTheDay'],
            'carbohydratesOfTheDay' => $userGoals['carbohydratesOfTheDay'],
            'proteinOfTheDay' => $userGoals['proteinOfTheDay'],
            'totalFatOfTheDay' => $userGoals['totalFatOfTheDay']
        ]);
    }

    public function add($type)
    {
        $foods = $this->_foodService->index();
        return view('goal.add', compact('foods', 'type'));
    }

    public function update($id)
    {
        $food = $this->_goalService->find($id);
        return view('goal.update', compact('food'));
    }

    public function search()
    {
        $date = $this->_request->input('date');
        $userGoals = $this->_userService->findUserGoals($date);

        return view('goal.index', [
            'date' => $userGoals['date'],
            'user' => $userGoals['user'],
            'breakfasts' => $userGoals['breakfast'],
            'lunchs' => $userGoals['lunch'],
            'snacks' => $userGoals['snack'],
            'dinners' => $userGoals['dinner'],
            'preWorkouts' => $userGoals['preWorkout'],
            'postWorkouts' => $userGoals['postWorkout'],
            'goalCalories' => $userGoals['goalCalories'],
            'goalCarbohydrate' => $userGoals['goalCarbohydrate'],
            'goalProtein' => $userGoals['goalProtein'],
            'goalTotalFat' => $userGoals['goalTotalFat'],
            'caloriesOfTheDay' => $userGoals['caloriesOfTheDay'],
            'carbohydratesOfTheDay' => $userGoals['carbohydratesOfTheDay'],
            'proteinOfTheDay' => $userGoals['proteinOfTheDay'],
            'totalFatOfTheDay' => $userGoals['totalFatOfTheDay']
        ]);
    }

    //Página de cálculo Taxa de Metabolismo Basal (TMB).
    public function settingGoalView()
    {

        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();

        return view('goal.settingGoal', compact('settingGoal'));
    }
}
