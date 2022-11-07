<?php

namespace App\Http\Repositories\Like;

use LaravelEasyRepository\Repository;

interface LikeRepository extends Repository
{
    public function updateLike($id);
    public function likeCount($id);
}
