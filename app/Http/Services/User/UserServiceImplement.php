<?php

namespace App\Http\Services\User;

use LaravelEasyRepository\Service;
use App\Http\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function whereNip($nip)
    {
        return $this->mainRepository->whereNip($nip);
    }
}
