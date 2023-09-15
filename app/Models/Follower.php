<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Follower extends Model
{

    protected $fillable = [
        'follower_id',
        'user_id'
    ];
}