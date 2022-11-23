<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasalMetabolicRate extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'gender',
        'age',
        'weight',
        'stature',
        'activity_rate_factor',
        'basal_metabolic_rate',
        'daily_protein',
        'daily_carbohydrate',
        'daily_fat'
    ];
}

