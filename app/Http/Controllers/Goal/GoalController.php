<?php

namespace App\Http\Controllers\Goal;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Repository\Food\FoodRepository;
use App\Repository\Goal\GoalRepository;

class GoalController extends Controller
{
    private $_userService;
    private $_foodRepository;
    private $_goalRepository;

    public function __construct(
        UserService $userService,
        FoodRepository $foodRepository,
        GoalRepository $goalRepository
    ) {
        $this->middleware('auth');
        $this->_userService = $userService;
        $this->_foodRepository = $foodRepository;
        $this->_goalRepository = $goalRepository;
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
        $foods = $this->_foodRepository->index();
        return view('goal.add', compact('foods', 'type'));
    }

    public function update($id)
    {
        $food = $this->_goalRepository->find($id);
        return view('goal.update', compact('food'));
    }
}
