<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\User\SearchName;
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
        return [
            SearchName::class
        ];
    }

    protected function thenReturn($userSearch)
    {
        return $userSearch;
    }
}
