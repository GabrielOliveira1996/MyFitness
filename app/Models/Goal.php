<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    
    protected $fillable = [
        'user_id',
        'user_name',
        'calories',
        'protein',
        'carbohydrate',
        'saturated_fat',
        'monounsaturated_fat',
        'polyunsaturated_fat'
    ];

}
