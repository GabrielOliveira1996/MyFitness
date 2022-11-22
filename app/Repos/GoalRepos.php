<?php

namespace App\Repos;

use Illuminate\Http\Request;
use App\Models\Goal;

class GoalRepos{

    private $_request;
    private $_goal;

    public function __construct(Request $request, Goal $goal){

        $this->_request = $request;
        $this->_goal = $goal;
    }

    public function allGoalRepos(){

        $this->_goal->all();

    }

}