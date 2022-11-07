<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\Comment\Search;
use App\Http\Searches\Filters\Comment\SearchByPost;
use App\Http\Searches\Filters\Comment\SearchByUser;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentSearch extends HttpSearch
{

    protected function passable()
    {
        return Comment::query();
    }

    protected function filters(): array
    {
        return [
            Search::class,
            SearchByPost::class,
            SearchByUser::class
        ];
    }

    protected function thenReturn($commentSearch)
    {
        return $commentSearch;
    }
}
