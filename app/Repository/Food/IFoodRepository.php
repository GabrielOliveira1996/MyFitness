<?php

namespace App\Repository\Food;

interface IFoodRepository
{
    public function index($userId);
    //public function wherePaginate($search, $data);
    public function create($food, $user);
    public function find($id, $userId);
    public function update($food, $user);
    public function delete($id);
    public function search($id, $food);
    public function searchByName($food);
    public function findUserFood($foodId, $userId);
}
