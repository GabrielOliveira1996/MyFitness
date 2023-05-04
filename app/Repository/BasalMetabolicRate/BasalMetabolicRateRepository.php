<?php

namespace App\Repository\BasalMetabolicRate;

use App\Repository\BasalMetabolicRate\IBasalMetabolicRateRepository;
use App\Models\BasalMetabolicRate;

class BasalMetabolicRateRepos implements IBasalMetabolicRateRepository
{

    private $_basalMetabolicRateRepos;

    public function __construct(IBasalMetabolicRateRepository $basalMetabolicRateRepos)
    {
        $this->_basalMetabolicRateRepos = $basalMetabolicRateRepos;
    }

    public function findUserBasalMetabolicRateRepos()
    {

        $userBasalMetabolicRateRepos = $this->_basalMetabolicRateRepos->where('user_id', auth()->user()->id)->first();

        return $userBasalMetabolicRateRepos;
    }

    public function settingBasalMetabolicRateRepos($data)
    {

        $dataExists = $this->_basalMetabolicRateRepos->where('user_id', auth()->user()->id)->first();

        if ($dataExists) {

            $settingBasalMetabolic = $dataExists->update([
                'user_id' => auth()->user()->id,
                'user_name' => auth()->user()->name,
                'gender' => $data['gender'],
                'age' => $data['age'],
                'weight' => $data['weight'],
                'stature' => $data['stature'],
                'activity_rate_factor' => $data['activity_rate_factor'],
                'objective' => $data['objective'],
                'type_of_diet' => $data['type_of_diet'],
                'imc' => $data['imc'],
                'water' => $data['water'],
                'basal_metabolic_rate' => $data['basal_metabolic_rate'],
                'daily_calories' => $data['daily_calories'],
                'daily_protein' => $data['daily_protein'],
                'daily_carbohydrate' => $data['daily_carbohydrate'],
                'daily_fat' => $data['daily_fat'],
                'daily_protein_kcal' => $data['daily_protein_kcal'],
                'daily_carbohydrate_kcal' => $data['daily_carbohydrate_kcal'],
                'daily_fat_kcal' => $data['daily_fat_kcal']
            ]);

            return $settingBasalMetabolic;
        }

        $settingBasalMetabolic = $this->_basalMetabolicRateRepos->create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'gender' => $data['gender'],
            'age' => $data['age'],
            'weight' => $data['weight'],
            'stature' => $data['stature'],
            'activity_rate_factor' => $data['activity_rate_factor'],
            'objective' => $data['objective'],
            'type_of_diet' => $data['type_of_diet'],
            'imc' => $data['imc'],
            'water' => $data['water'],
            'basal_metabolic_rate' => $data['basal_metabolic_rate'],
            'daily_calories' => $data['daily_calories'],
            'daily_protein' => $data['daily_protein'],
            'daily_carbohydrate' => $data['daily_carbohydrate'],
            'daily_fat' => $data['daily_fat']
        ]);

        return $settingBasalMetabolic;
    }
}
