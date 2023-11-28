<?php

namespace App\Http\Controllers\Goal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Food\FoodRepository;
use App\Repository\Goal\GoalRepository;
use Illuminate\Support\Facades\Auth;

class ApiGoalController extends Controller
{
    private $_request;
    private $_foodRepository;
    private $_goalRepository;
    private $_timezone;

    public function __construct(Request $request, FoodRepository $foodRepository, GoalRepository $goalRepository){
        $this->middleware('auth:sanctum');
        $this->_request = $request;
        $this->_foodRepository = $foodRepository;
        $this->_goalRepository = $goalRepository;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function index($date){
        $user = Auth::user(); // Só é permitido com token
        $goalFoods = $this->_goalRepository->goalFoods($date, $user);
        $totalConsumption = $this->_goalRepository->totalConsumption($date, $user);
        return response()->json([
            'message' => 'Data located successfully.',
            'goalFoods'=> $goalFoods,
            'totalConsumption' => $totalConsumption,
        ]);
    }

    public function delete(){
        try{
            $id = $this->_request->input('id');
            $delete = $this->_goalRepository->delete($id);
            if(!$id || $delete === 0){
                throw new \Exception('Alimento não foi localizado para exclusão.', 404);
            };
            return response()->json([
                'message' => 'Successfully located food.',
                'success' => 'Alimento foi excluído com sucesso.'
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unsuccessfully located food.',
                'error' => $e->getMessage(),
            ], 200);
        }
    }

    public function searchFood(){
        try{
            $food = $this->_request->input('name');
            $foods = $this->_foodRepository->searchByName($food);
            if(!$food || count($foods) === 0){
                throw new \Exception('O alimento não foi encontrado.', 404);
            }
            return response()->json([
                'message' => 'Successfully located foods.',
                'search' => $food,
                'foods' => $foods, 
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unsuccessfully located foods.',
                'error' => $e->getMessage(),
            ], 200);
        }
    }

    public function searchGoalByDate($date){
        try{
            $user = Auth::user();
            $goalFoods = $this->_goalRepository->goalFoods($date, $user);
            $totalConsumption = $this->_goalRepository->totalConsumption($date, $user);
            return response()->json([
                'message' => 'Successfully located foods.',
                'date' => $date,
                'goalFoods' => $goalFoods, 
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Unsuccessfully located foods.',
                'error' => $e->getMessage(),
            ], 200);
        }
    }
}
