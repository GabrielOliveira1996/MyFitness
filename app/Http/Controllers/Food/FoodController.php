<?php

namespace App\Http\Controllers\Food;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Food\IFoodRepository;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    private $_request;
    private $_foodRepository;

    public function __construct(Request $request, IFoodRepository $foodRepository){
        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodRepository = $foodRepository;
    }

    public function index(){
        try{
            $userId = Auth::user()->id;
            $foods = $this->_foodRepository->index($userId);
            if(count($foods) === 0){
                throw new \Exception('Nenhum alimento foi encontrado. Clique no botão acima para adicionar um alimento a sua lista.', 404);
            }
            return view('food.all', compact('foods'));
        }catch(\Exception $e){
            return view('food.all', ['unsuccessfully' => $e->getMessage()]);
        }
    }
}
