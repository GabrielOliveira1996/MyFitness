<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_terms',
        'profile_image',
        'google_id',
        'gender',
        'age',
        'weight',
        'stature',
        'activity_rate_factor',
        'objective',
        'type_of_diet',
        'imc',
        'water',
        'daily_calories',
        'daily_protein',
        'daily_carbohydrate',
        'daily_fat',
        'daily_protein_kcal',
        'daily_carbohydrate_kcal',
        'daily_fat_kcal'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
