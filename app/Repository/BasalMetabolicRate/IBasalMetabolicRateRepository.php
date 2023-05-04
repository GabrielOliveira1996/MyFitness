<?php

namespace App\Repository\BasalMetabolicRate;

interface IBasalMetabolicRateRepository
{
    public function findUserBasalMetabolicRateRepos();
    public function settingBasalMetabolicRateRepos($data);
}
