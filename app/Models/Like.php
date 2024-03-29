<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class Like extends Model
{

    protected $fillable = [
            'user_id',
            'post_id',
            'comment_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}