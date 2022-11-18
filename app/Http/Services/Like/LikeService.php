<?php

namespace App\Http\Services\Like;

use LaravelEasyRepository\BaseService;

interface LikeService extends BaseService
{
    public function status($id);
}
