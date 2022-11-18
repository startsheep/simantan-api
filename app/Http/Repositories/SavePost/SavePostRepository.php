<?php

namespace App\Http\Repositories\SavePost;

use LaravelEasyRepository\Repository;

interface SavePostRepository extends Repository
{
    public function findByCriteria(array $criteria);
}
