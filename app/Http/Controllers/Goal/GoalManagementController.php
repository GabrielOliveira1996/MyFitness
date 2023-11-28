<?php

namespace App\Http\Controllers\Goal;

use Illuminate\Http\Request;
use App\Services\GoalService;
use App\Http\Controllers\Controller;
use App\Repository\Goal\GoalRepository;
use App\Services\UserService;
use App\Repository\Food\IFoodRepository;
use Illuminate\Support\Facades\Auth;

class GoalManagementController extends Controller
{
    private $_request;
    private $_goalService;
    private $_userService;
    private $_goalRepository;
    private $_foodRepository;
    private $_timezone;

    public function __construct(
        Request $request,
        GoalService $goalService,
        UserService $userService,
        GoalRepository $goalRepository,
        IFoodRepository $foodRepository
    ) {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_goalService = $goalService;
        $this->_userService = $userService;
        $this->_goalRepository = $goalRepository;
        $this->_foodRepository = $foodRepository;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function add($date){
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
        $create = $this->_goalService->create(\Auth::user(), $date, $goal);
        return redirect()->route('goal.index', compact('date'));
    }

    public function update($date){
        try{
            if(!$date){
                throw new \Exception('Nenhuma data foi fornecida.', 404);
            }
            $goal = $this->_request->only([
                'id',
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
            if(!$goal){
                throw new \Exception('As informações do alimento a ser atualizado não foram fornecidas.', 404);
            }
            $food = $this->_goalRepository->update($goal);
            if(!$food){
                throw new \Exception('Não houve atualização de informações sobre nenhum alimento.', 404);
            }
            return redirect()->route('goal.index', compact('date'));
        }catch(\Exception $e){
            return redirect()->route('goal.index', ['date' => $date, 'error' => $e->getMessage()]);
        }
    }
}
