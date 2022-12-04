<?php

namespace App\Http\Searches\Filters\User;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;

class SearchName implements FilterContract
{
    /** @var string|null */
    protected $searchName;

    /**
     * @param string|null $searchName
     * @return void
     */
    public function __construct($searchName)
    {
        $this->searchName = $searchName;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (!$this->keyword()) {
            return $next($query);
        }
        $query->where('name', 'LIKE', '%' . $this->searchName . '%');

        return $next($query);
    }

    /**
     * Get searchName keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->searchName) {
            return $this->searchName;
        }

        $this->searchName = request('search', null);

        return request('search');
    }
}
