<?php

namespace App\Http\Searches;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserSearch extends HttpSearch
{
    protected function passable()
    {
        return User::query();
    }

    protected function filters(): array
    {
        return [];
    }

    protected function thenReturn($userSearch)
    {
        return $userSearch;
    }
}
