<?php

namespace App\Services;

use App\Repository\Food\IFoodRepository;
use Illuminate\Support\Facades\Auth;
use App\Validator\FoodValidator;

class FoodService
{
    private $_foodRepository;
    private $_foodValidator;

    public function __construct(IFoodRepository $foodRepository, FoodValidator $foodValidator)
    {
        $this->_foodRepository = $foodRepository;
        $this->_foodValidator = $foodValidator;
    }

    public function create($food)
    {
        $user = Auth::user();
        $this->_foodValidator->create($food);
        $create = $this->_foodRepository->create($food, $user);
        return $create;
    }

    public function update($id, $food)
    {
        $user = Auth::user();
        $this->_foodValidator->update($food);
        $update = $this->_foodRepository->update($id, $food, $user);
        return $update;
    }

    public function indexUserFoods()
    {
        $id = Auth::user()->id;
        $foods = $this->_foodRepository->wherePaginate('user_id', $id);
        return $foods;
    }

    public function find($id) // Alimentos apenas do usuário
    {
        $find = $this->_foodRepository->find($id);
        return $find;
    }
}
