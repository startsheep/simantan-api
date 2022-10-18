<?php

namespace App\Http\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function whereNip($nip);
}
