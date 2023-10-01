<?php

namespace App\Http\Controllers\Food;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Http\Controllers\Controller;
use App\Repository\Food\IFoodRepository;
use Illuminate\Support\Facades\Auth;
use App\Validator\FoodValidator;

class FoodManagementController extends Controller
{
    private $_request;
    private $_foodService;
    private $_foodRepository;
    private $_foodValidator;

    public function __construct(
        Request $request, 
        FoodService $foodService, 
        IFoodRepository $foodRepository,
        FoodValidator $foodValidator
        )
    {
        $this->middleware('auth');
        $this->_request = $request;
        $this->_foodService = $foodService;
        $this->_foodRepository = $foodRepository;
        $this->_foodValidator = $foodValidator;
    }

    public function create(){
        $food = $this->_request->only([
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat'
        ]);
        $user = Auth::user();
        $this->_foodValidator->create($food);
        $create = $this->_foodRepository->create($food, $user);
        return redirect()->route('food.all');
    }

    public function update($id){
        $food = $this->_request->only([
            'name',
            'quantity_grams',
            'calories',
            'carbohydrate',
            'protein',
            'total_fat',
            'saturated_fat',
            'trans_fat'
        ]);
        $user = Auth::user();
        $this->_foodValidator->update($food);
        $update = $this->_foodRepository->update($id, $food, $user);
        return redirect()->route('food.all');
    }

    public function delete($id){
        $this->_foodRepository->delete($id);
        return redirect()->route('food.all');
    }

    public function search(){
        try{
            $id = Auth::user()->id;
            $food = $this->_request->input('name');
            $foods = $this->_foodRepository->search($id, $food);
            if(empty($users->$foods)){
                throw new \Exception('Alimento não encontrado.');
            }
            return view('food.all', compact('foods'));
        }catch(\Exception $e){
            return redirect()->route('food.all')->with('unsuccessfully', $e->getMessage());
        }
    }
}
