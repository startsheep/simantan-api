<?php

namespace App\Http\Searches;

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
        return [];
    }

    protected function thenReturn($commentSearch)
    {
        return $commentSearch;
    }
}
