<?php

namespace App\Http\Searches\Filters\Flag;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;
use App\Models\Flag;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class Sort implements FilterContract
{
    /** @var string|null */
    protected $sort;

    /**
     * @param string|null $sort
     * @return void
     */
    public function __construct($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        $query->leftJoin('posts', 'flags.id', '=', 'posts.flag_id')
            ->selectRaw('flags.*, count(posts.id) as total')
            ->groupBy('flags.name')
            ->orderBy('total', 'desc');
        return $next($query);
    }

    /**
     * Get sort keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->sort) {
            return $this->sort;
        }

        $this->sort = request('sort', null);

        return request('sort');
    }
}
