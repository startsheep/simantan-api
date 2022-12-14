<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\Post\Search;
use App\Http\Searches\Filters\Post\SearchByFlag;
use App\Http\Searches\Filters\Post\SearchByUser;
use App\Models\Post;

class PostSearch extends HttpSearch
{
    protected function passable()
    {
        return Post::query();
    }

    protected function filters(): array
    {
        return [
            Search::class,
            SearchByUser::class,
            SearchByFlag::class,
        ];
    }

    protected function thenReturn($postSearch)
    {
        return $postSearch;
    }
}
