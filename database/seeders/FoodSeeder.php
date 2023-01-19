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

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Batata Doce (Cozida)',
            'quantity_grams' => 100,
            'calories' => 77,
            'carbohydrate' => 18.40,
            'protein' => 0.60,
            'total_fat' => 0.10,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Batata Doce (Cozida)',
            'quantity_grams' => 100,
            'calories' => 77,
            'carbohydrate' => 18.40,
            'protein' => 0.60,
            'total_fat' => 0.10,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Aveia',
            'quantity_grams' => 100,
            'calories' => 394,
            'carbohydrate' => 57.50,
            'protein' => 13.90,
            'total_fat' => 0,
            'saturated_fat' => 1.50,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Massa de Tapioca (Cozida)',
            'quantity_grams' => 100,
            'calories' => 329,
            'carbohydrate' => 81.10,
            'protein' => 0.50,
            'total_fat' => 0.30,
            'saturated_fat' => 0,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Macarrão (Cozida)',
            'quantity_grams' => 100,
            'calories' => 158,
            'carbohydrate' => 29.06,
            'protein' => 5.80,
            'total_fat' => 0.93,
            'saturated_fat' => 0.18,
            'trans_fat' => 0
        ]);

        Food::create([
            'user_id' => 1,
            'user_name' => 'Gabriel',
            'name' => 'Feijão Carioca (Cozida)',
            'quantity_grams' => 100,
            'calories' => 76,
            'carbohydrate' => 13.60,
            'protein' => 4.80,
            'total_fat' => 0.50,
            'saturated_fat' => 0.10,
            'trans_fat' => 0
        ]);

    }
}
