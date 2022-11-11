<?php

namespace App\Http\Services\Post;

use LaravelEasyRepository\BaseService;

interface PostService extends BaseService
{
    public function updateLike($id, array $attributes);
    public function countLike($id);
}
