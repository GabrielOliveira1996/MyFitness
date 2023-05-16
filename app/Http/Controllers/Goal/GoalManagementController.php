<?php

namespace App\Http\Controllers\Goal;

use Illuminate\Http\Request;
use App\Services\GoalService;
use App\Http\Controllers\Controller;
use App\Repository\Goal\GoalRepository;
use App\Services\UserService;

class GoalManagementController extends Controller
{
    private $_request;
    private $_goalService;
    private $_userService;
    private $_goalRepository;

    public function __construct(
        Request $request,
        GoalService $goalService,
        UserService $userService,
        GoalRepository $goalRepository
    ) {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_goalService = $goalService;
        $this->_userService = $userService;
        $this->_goalRepository = $goalRepository;
    }

    public function add($type)
    {
        $goal = $this->_request->only([
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat',
            'type_of_meal'
        ]);
        $create = $this->_goalService->create($type, $goal);
        return redirect()->route('goal.index');
    }

    public function update($id)
    {
        $goal = $this->_request->only([
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat',
            'type_of_meal'
        ]);
        $food = $this->_goalService->update($id, $goal);
        return redirect()->route('goal.index');
    }

    public function delete($id)
    {
        $delete = $this->_goalRepository->delete($id);
        return redirect()->route('goal.index');
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
}
