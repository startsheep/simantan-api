<?php

namespace App\Http\Searches\Filters\Comment;

use App\Http\Searches\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SearchByPost implements FilterContract
{
    /** @var string|null */
    protected $searchByPost;

    /**
     * @param  string|null  $searchByPost
     * @return void
     */
    public function __construct($searchByPost)
    {
        $this->searchByPost = $searchByPost;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (! $this->keyword()) {
            return $next($query);
        }

        $query->where(function ($query) {
            $query->whereHas('post', function ($post) {
                $post->where('id', $this->searchByPost);
            });
        });

        return $next($query);
    }

    /**
     * Get searchByPost keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->searchByPost) {
            return $this->searchByPost;
        }

        $this->searchByPost = request('post', null);

        return request('post');
    }
}
