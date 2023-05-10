<?php

namespace App\Http\Controllers\Goal;

use Illuminate\Http\Request;
use App\Services\GoalService;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class GoalManagementController extends Controller
{
    private $_request;
    private $_goalService;
    private $_userService;

    public function __construct(Request $request, GoalService $goalService, UserService $userService)
    {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_goalService = $goalService;
        $this->_userService = $userService;
    }

    public function add($type)
    {
        $goal = $this->_request->only([
            'user_id',
            'user_name',
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
            'user_id',
            'user_name',
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat'
        ]);
        $food = $this->_goalService->update($id, $goal);
        return redirect()->route('goal.index');
    }

    public function delete($id)
    {
        $delete = $this->_goalService->delete($id);
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
