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
            'email' => 'gab-oliveira@hotmail.com',
            'password' => Hash::make('123456789'),
        ]);

        BasalMetabolicRate::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'gender' => 0,
            'age' => 0,
            'weight' => 0,
            'stature' => 0,
            'activity_rate_factor' => 0,
            'objective' => 0,
            'type_of_diet' => 'Padrão',
            'imc' => 0,
            'water' => 0,
            'basal_metabolic_rate' => 0,
            'daily_calories' => 0,
            'daily_protein' => 0,
            'daily_carbohydrate' => 0,
            'daily_fat' => 0,
            'daily_protein_kcal' => 0,
            'daily_carbohydrate_kcal' => 0,
            'daily_fat_kcal' => 0
        ]);

    }
}
