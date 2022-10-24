<?php

namespace App\Http\Repositories\Post;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface PostRepository extends Repository
{
    public function httpSearch(Request $request);

    public function getFillable();
}
