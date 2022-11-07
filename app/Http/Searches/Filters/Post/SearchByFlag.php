<?php

namespace App\Http\Searches\Filters\Post;

use App\Http\Searches\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SearchByFlag implements FilterContract
{
    /** @var string|null */
    protected $flag;

    /**
     * @param  string|null  $flag
     * @return void
     */
    public function __construct($flag)
    {
        $this->flag = $flag;
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
            $query->whereHas('flag', function ($flag) {
                $flag->where('id', $this->flag)
                    ->orWhere('name', 'like', '%'.$this->flag.'%');
            });
        });

        return $next($query);
    }

    /**
     * Get flag keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->flag) {
            return $this->flag;
        }

        $this->flag = request('flag', null);

        return request('flag');
    }
}
