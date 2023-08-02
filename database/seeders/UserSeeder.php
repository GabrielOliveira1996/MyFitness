<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BasalMetabolicRate;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Gabriel',
            'email' => 'admin@myfitness.com',
            'password' => Hash::make('Aa1234567/'),
            'confirm_terms' => 1,
            'gender' => 1,
            'age' => 25,
            'weight' => 63,
            'stature' => 168,
            'activity_rate_factor' => 1.38,
            'objective' => 3,
            'type_of_diet' => 1,
            'imc' => 22.30,
            'water' => 2205,
            'daily_calories' => 2206,
            'daily_protein' => 116.60,
            'daily_carbohydrate' => 291.70,
            'daily_fat' => 78.80,
            'daily_protein_kcal' => 504,
            'daily_carbohydrate_kcal' => 1194.60,
            'daily_fat_kcal' => 728
        ]);
    }
}
