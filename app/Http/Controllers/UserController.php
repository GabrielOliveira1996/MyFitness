<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\IBasalMetabolicRateRepos;

class UserController extends Controller
{

    private $_request;
    private $_basalMetabolicRateRepos;

    public function __construct(Request $request, IBasalMetabolicRateRepos $basalMetabolicRateRepos){

        $this->middleware('auth');
        $this->_request = $request;
        $this->_basalMetabolicRateRepos = $basalMetabolicRateRepos;

    }

    //Views.
    public function perfil(){

        $user = Auth::user();
        $settingGoal = $this->_basalMetabolicRateRepos->findUserBasalMetabolicRateRepos();
        
        return view('perfil', compact('user', 'settingGoal'));
    }  

    public function perfilUpdate(){

        $data = $this->_request->all();
        
        $settingGoal = $this->_basalMetabolicRateRepos->settingBasalMetabolicRateRepos($data);

        return redirect()->route('perfil');
    }

}
