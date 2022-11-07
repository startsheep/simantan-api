<?php

namespace App\Http\Searches\Filters\Comment;

use App\Http\Searches\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SearchByUser implements FilterContract
{
    /** @var string|null */
    protected $searchByUser;

    /**
     * @param  string|null  $searchByUser
     * @return void
     */
    public function __construct($searchByUser)
    {
        $this->searchByUser = $searchByUser;
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
            $query->whereHas('user', function ($user) {
                $user->where('id', $this->searchByUser);
            });
        });

        return $next($query);
    }

    /**
     * Get searchByUser keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->searchByUser) {
            return $this->searchByUser;
        }

        $this->searchByUser = request('user', null);

        return request('user');
    }
}
