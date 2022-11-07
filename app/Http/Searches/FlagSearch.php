<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\Flag\Search;
use App\Models\Flag;

class FlagSearch extends HttpSearch
{
    protected function passable()
    {
        return Flag::query();
    }

    protected function filters(): array
    {
        return [
            Search::class,
        ];
    }

    protected function thenReturn($flagSearch)
    {
        return $flagSearch;
    }
}
