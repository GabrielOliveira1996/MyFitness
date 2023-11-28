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
    private $_timezone;

    public function __construct(UserService $userService, FoodRepository $foodRepository, GoalRepository $goalRepository){
        $this->middleware('auth');
        $this->_userService = $userService;
        $this->_foodRepository = $foodRepository;
        $this->_goalRepository = $goalRepository;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function index($date){
        $user = \Auth::user();
        $totalConsumption = $this->_goalRepository->totalConsumption($date, $user);
        return view('goal.index', compact('date', 'user', 'totalConsumption'));
    }

    public function update($id){
        $food = $this->_goalRepository->find($id);
        return view('goal.update', compact('food'));
    }
}
