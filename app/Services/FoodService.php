<?php

namespace App\Services;

use App\Repository\Food\IFoodRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FoodService
{
    private $_foodRepository;

    public function __construct(IFoodRepository $foodRepository)
    {
        $this->_foodRepository = $foodRepository;
    }

    public function create($food)
    {
        $user = Auth::user();
        $create = $this->_foodRepository->create($food, $user);
        return $create;
    }

    public function update($id, $food)
    {
        $user = Auth::user();
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

    public function delete($id)
    {
        $delete = $this->_foodRepository->delete($id);
    }

    public function index()
    {
        $index = $this->_foodRepository->index();
        return $index;
    }

    public function search($food)
    {
        $search = $this->_foodRepository->search($food);
        return $search;
    }
}
