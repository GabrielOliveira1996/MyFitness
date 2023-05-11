<?php

namespace App\Services;

use App\Repository\Goal\IGoalRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GoalService
{
    private $_goalRepository;
    private $_timezone;

    public function __construct(IGoalRepository $goalRepository)
    {
        $this->_goalRepository = $goalRepository;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function create($type, $goal)
    {
        $user = Auth::user();
        $create = $this->_goalRepository->create($type, $goal, $user);
        return $create;
    }

    public function find($id)
    {
        $find = $this->_goalRepository->find($id);
        return $find;
    }

    public function update($id, $goal)
    {
        $update = $this->_goalRepository->update($id, $goal);
        return $update;
    }

    public function delete($id)
    {
        $delete = $this->_goalRepository->delete($id);
        return $delete;
    }
}
