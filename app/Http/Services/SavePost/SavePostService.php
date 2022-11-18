<?php

namespace App\Http\Services\SavePost;

use LaravelEasyRepository\BaseService;

interface SavePostService extends BaseService
{
    public function save($id);
}
