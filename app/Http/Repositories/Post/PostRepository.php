<?php

namespace App\Http\Repositories\Post;

use LaravelEasyRepository\Repository;

interface PostRepository extends Repository
{
    public function getFillable();
}
