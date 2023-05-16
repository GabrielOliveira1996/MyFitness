<?php

namespace App\Services;

use App\Repository\Goal\IGoalRepository;
use Illuminate\Support\Facades\Auth;
use App\Validator\GoalValidator;

class GoalService
{
    private $_goalRepository;
    private $_goalValidator;
    private $_timezone;

    public function __construct(IGoalRepository $goalRepository, GoalValidator $goalValidator)
    {
        $this->_goalRepository = $goalRepository;
        $this->_goalValidator = $goalValidator;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function create($type, $goal)
    {
        $goal += ['type_of_meal' => $type];
        $user = Auth::user();
        $this->_goalValidator->food($goal);
        $create = $this->_goalRepository->create($type, $goal, $user);
        return $create;
    }

    public function update($id, $goal)
    {
        $this->_goalValidator->food($goal);
        $update = $this->_goalRepository->update($id, $goal);
        return $update;
    }
}
