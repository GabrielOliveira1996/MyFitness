<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name',
        'protein',
        'carbohydrate',
        'saturated_fat',
        'monounsaturated_fat',
        'polyunsaturated_fat'
    ];
}
