<?php

namespace App\Http\Searches\Filters\Post;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;

class SearchByUser implements FilterContract
{
    /** @var string|null */
    protected $user;

    /**
     * @param string|null $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (!$this->keyword()) {
            return $next($query);
        }

        $query->where(function ($query) {
            $query->whereHas('user', function ($user) {
                $user->where('id', $this->user)
                    ->orWhere('name', 'like', '%' . $this->user . '%');
            });
        });

        return $next($query);
    }

    /**
     * Get user keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->user) {
            return $this->user;
        }

        $this->user = request('user', null);

        return request('user');
    }
}
