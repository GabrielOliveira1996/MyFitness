<?php

namespace App\Services;

use App\Validator\UserValidator;
use App\Repository\User\IUserRepository;
use Illuminate\Support\Facades\Auth;
use App\Repository\Goal\IGoalRepository;

class UserService
{
    private $_userValidator;
    private $_userRepository;
    private $_goalRepository;
    private $_timezone;

    public function __construct(UserValidator $userValidator, IUserRepository $userRepository, IGoalRepository $goalRepository)
    {
        $this->_userValidator = $userValidator;
        $this->_userRepository = $userRepository;
        $this->_goalRepository = $goalRepository;
        $this->_timezone = date_default_timezone_set('America/Sao_Paulo');
    }

    public function register($user)
    {
        $validator = $this->_userValidator->register($user);
        $createUser = $this->_userRepository->create($user);
    }

    public function update($user)
    {
        $id = Auth::user()->id;
        $update = $this->_userRepository->update($user, $id);
        return $update;
    }

    public function findUserGoals($date)
    {
        $id = Auth::user()->id;
        $user = $this->_userRepository->find($id);

        //Tipos de refeição.
        $breakfast = $this->_goalRepository->breakfast($date);
        $lunch = $this->_goalRepository->lunch($date);
        $snack = $this->_goalRepository->snack($date);
        $dinner = $this->_goalRepository->dinner($date);
        $preWorkout = $this->_goalRepository->preWorkout($date);
        $postWorkout = $this->_goalRepository->postWorkout($date);

        //Metas estabelecidas pelo usuário.
        if ($user) {
            $goalCalories = $user['daily_calories'];
            $goalCarbohydrate = $user['daily_carbohydrate'];
            $goalProtein = $user['daily_protein'];
            $goalTotalFat = $user['daily_fat'];
        }

        //Resultados do dia.
        $caloriesOfTheDay = array_sum([
            $breakfast->sum('calories'),
            $lunch->sum('calories'),
            $snack->sum('calories'),
            $dinner->sum('calories'),
            $preWorkout->sum('calories'),
            $postWorkout->sum('calories')
        ]);

        $carbohydratesOfTheDay = array_sum([
            $breakfast->sum('carbohydrate'),
            $lunch->sum('carbohydrate'),
            $snack->sum('carbohydrate'),
            $dinner->sum('carbohydrate'),
            $preWorkout->sum('carbohydrate'),
            $postWorkout->sum('carbohydrate')
        ]);

        $proteinOfTheDay = array_sum([
            $breakfast->sum('protein'),
            $lunch->sum('protein'),
            $snack->sum('protein'),
            $dinner->sum('protein'),
            $preWorkout->sum('protein'),
            $postWorkout->sum('protein')
        ]);

        $totalFatOfTheDay = array_sum([
            $breakfast->sum('total_fat'),
            $lunch->sum('total_fat'),
            $snack->sum('total_fat'),
            $dinner->sum('total_fat'),
            $preWorkout->sum('total_fat'),
            $postWorkout->sum('total_fat')
        ]);

        return [
            'date' => $date,
            'user' => $user,
            'breakfast' => $breakfast,
            'lunch' => $lunch,
            'snack' => $snack,
            'dinner' => $dinner,
            'preWorkout' => $preWorkout,
            'postWorkout' => $postWorkout,
            'goalCalories' => $goalCalories,
            'goalCarbohydrate' => $goalCarbohydrate,
            'goalProtein' => $goalProtein,
            'goalTotalFat' => $goalTotalFat,
            'caloriesOfTheDay' => $caloriesOfTheDay,
            'carbohydratesOfTheDay' => $carbohydratesOfTheDay,
            'proteinOfTheDay' => $proteinOfTheDay,
            'totalFatOfTheDay' => $totalFatOfTheDay
        ];
    }
}