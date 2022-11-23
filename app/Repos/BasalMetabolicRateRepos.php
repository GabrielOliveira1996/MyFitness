<?php

namespace App\Repos;

use Illuminate\Http\Request;
use App\Contracts\IBasalMetabolicRateRepos;
use App\Models\BasalMetabolicRate;

class BasalMetabolicRateRepos implements IBasalMetabolicRateRepos{

    private $_request;
    private $_basalMetabolicRateRepos;

    public function __construct(Request $request, BasalMetabolicRate $basalMetabolicRateRepos){

        $this->_request = $request;
        $this->_basalMetabolicRepos = $basalMetabolicRateRepos;
    }

    public function findUserBasalMetabolicRateRepos(){

        $userBasalMetabolicRateRepos = $this->_basalMetabolicRepos->where('user_id', auth()->user()->id)->first();

        return $userBasalMetabolicRateRepos;

    }
    
    public function settingBasalMetabolicRateRepos($data){

        $dataExists = $this->_basalMetabolicRepos->where('user_id', auth()->user()->id)->first();

        if($dataExists){

            $settingBasalMetabolic = $this->_basalMetabolicRepos->update([
                'user_id' => auth()->user()->id,
                'user_name' => auth()->user()->name,
                'gender' => $data['gender'],
                'age' => $data['age'],
                'weight' => $data['weight'],
                'stature' => $data['stature'],
                'activity_rate_factor' => $data['activity_rate_factor'],
                'basal_metabolic_rate' => $data['basal_metabolic_rate'],
                'daily_protein' => $data['daily_protein'],
                'daily_carbohydrate' => $data['daily_carbohydrate'],
                'daily_fat' => $data['daily_fat']
            ]);

            return $settingBasalMetabolic;
        }

        $settingBasalMetabolic = $this->_basalMetabolicRepos->create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'gender' => $data['gender'],
            'age' => $data['age'],
            'weight' => $data['weight'],
            'stature' => $data['stature'],
            'activity_rate_factor' => $data['activity_rate_factor'],
            'basal_metabolic_rate' => $data['basal_metabolic_rate'],
            'daily_protein' => $data['daily_protein'],
            'daily_carbohydrate' => $data['daily_carbohydrate'],
            'daily_fat' => $data['daily_fat']
        ]);

        return $settingBasalMetabolic;
    }
    
}