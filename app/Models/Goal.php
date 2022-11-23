<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    
    protected $fillable = [
        'user_id',
        'user_name',
        'name',
        'quantity_grams',
        'calories',
        'carbohydrate',
        'protein',
        'total_fat',
        'saturated_fat',
        'trans_fat',
        'date'
    ];

}
