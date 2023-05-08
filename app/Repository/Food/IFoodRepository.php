<?php

namespace App\Repository\Food;

interface IFoodRepository
{
    public function index();
    public function wherePaginate($search, $data);
    public function create($food, $user);
    public function find($id);
    public function update($id, $food, $user);
    public function delete($id);
}
