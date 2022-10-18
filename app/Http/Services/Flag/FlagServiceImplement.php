<?php

namespace App\Http\Services\Flag;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Flag\FlagRepository;

class FlagServiceImplement extends Service implements FlagService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(FlagRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
