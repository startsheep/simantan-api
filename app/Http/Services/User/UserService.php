<?php

namespace App\Http\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
    public function whereNip($nip);

    public function changePassword($id, $attributes);
}
