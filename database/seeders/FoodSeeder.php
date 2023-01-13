<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Soja (Cozida)',
            'quantity_grams' => 100,
            'calories' => 173,
            'carbohydrate' => 10,
            'protein' => 16,
            'total_fat' => 9,
            'saturated_fat' => 1,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Arroz Integral (Cozida)',
            'quantity_grams' => 100,
            'calories' => 124,
            'carbohydrate' => 25,
            'protein' => 3,
            'total_fat' => 1,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Arroz Parboilizado (Cozida)',
            'quantity_grams' => 100,
            'calories' => 123,
            'carbohydrate' => 26,
            'protein' => 3,
            'total_fat' => 1,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Batata Inglesa (Cozida)',
            'quantity_grams' => 100,
            'calories' => 86,
            'carbohydrate' => 20,
            'protein' => 2,
            'total_fat' => 0,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Pasta De Amendoim',
            'quantity_grams' => 15,
            'calories' => 91,
            'carbohydrate' => 3,
            'protein' => 4,
            'total_fat' => 7,
            'saturated_fat' => 1,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Pão Integral',
            'quantity_grams' => 100,
            'calories' => 247,
            'carbohydrate' => 41,
            'protein' => 13,
            'total_fat' => 3,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Banana Prata',
            'quantity_grams' => 100,
            'calories' => 99,
            'carbohydrate' => 26,
            'protein' => 1,
            'total_fat' => 1,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

    }
}
