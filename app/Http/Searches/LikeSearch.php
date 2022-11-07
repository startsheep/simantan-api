<?php

namespace App\Http\Searches;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;

class LikeSearch extends HttpSearch
{

    protected function passable()
	{
		return Like::query();
	}

	protected function filters(): array
	{
		return [

		];
	}

	protected function thenReturn($likeSearch)
	{
		return $likeSearch;
	}
}
