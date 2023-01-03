<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Contracts\IBasalMetabolicRateRepos;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class GoalControllerAPI extends Controller
{

    private $_request;
    private $_basalMetabolicRateRepos;

    public function __construct(Request $request, IBasalMetabolicRateRepos $basalMetabolicRateRepos){

        //$this->middleware('auth:sanctum');
        $this->_request = $request;
        $this->_basalMetabolicRateRepos = $basalMetabolicRateRepos;
        
    }

    public function createBasalMetabolicRateRepos(){
        
        $data = $this->_request->all();

        $this->_basalMetabolicRateRepos->settingBasalMetabolicRateRepos($data);
         
    }

}
