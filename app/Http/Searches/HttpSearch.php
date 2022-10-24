<?php

namespace App\Http\Searches;

use App\Http\Abstracts\Form;
use RuntimeException;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Http\Services\Traits\BaseFoundation;
use App\Http\Traits\BaseFoundation as TraitsBaseFoundation;
use Illuminate\Contracts\Container\Container as Laravel;

abstract class HttpSearch extends Form
{
    use TraitsBaseFoundation;

    /** @var array */
    protected $parameters = [];

    /** @var Pipeline */
    protected $pipeline;

    /** @var Laravel|null */
    protected $laravel;

    /** @var Request */
    protected $request;

    /** @var array */
    protected $filters = [];

    /**
     * Undocumented function
     *
     * @param  Pipeline $pipeline
     * @param  Laravel|null  $laravel
     * @param  Request $request
     * @return void
     */
    public function __construct(Pipeline $pipeline, Request $request, Laravel $laravel = null)
    {
        $this->pipeline = $pipeline;
        $this->request = $request;
        $this->laravel = $laravel;
    }

    /**
     * Search using pipeline.
     *
     * @param  mixed  ...$params
     * @return mixed
     */
    public function apply(...$params)
    {
        if (!empty($params)) {
            $this->parameters = $params['0'];
        } elseif (!empty($this->request)) {
            $this->parameters = $this->request->all();
        }

        if (!method_exists($this, 'passable')) {
            throw new RuntimeException("passable method not exists.");
        }

        $result = $this->pipeline->send($this->{'passable'}(...$params))
            ->through($this->parsedFilters())
            ->thenReturn();

        return $this->thenReturn($result) ?? $result;
    }

    protected function filters(): array
    {
        return $this->filters;
    }

    /**
     * @param  mixed  $result
     * @return mixed
     */
    protected function thenReturn($result)
    {
        return;
    }

    protected function parsedFilters(): array
    {
        $filters = collect($this->filters())->map(function ($filter) {
            if (is_object($filter)) {
                return $filter;
            }

            if (!class_exists($filter)) {
                return $filter;
            }

            return $this->resolveClassIdentification($filter);
        });

        return $filters->all();
    }
}
