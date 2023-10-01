<?php

namespace App\Repository\Post;

interface IPostRepository
{
    public function create($user, $post);
    public function getAll($nickname);
}
