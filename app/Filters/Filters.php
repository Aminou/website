<?php
namespace App\Filters;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $params, $builder, $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->params = $this->setFilters();
    }

    public function apply($query)
    {
        $this->builder = $query;

        if ($this->params->count() > 0) {
            $this->filters()->each(function ($filter, $value) {
                $this->$filter($value);
            });
        }

        return $this->builder;
    }

    private function setFilters() : Collection
    {
        if ($this->request->segment(2) === 'filters') {

            $segments = collect($this->request->segments())->slice(2);

            $filters = $segments->nth(2);
            $values = $segments->nth(2, 1);

            return $filters->combine($values);
        }

        return collect();

    }

    private function filters() : Collection
    {
        $filters = $this->getFiltersFromChildClass();

        return $this->params->filter(function ($value, $key) use ($filters) {
            return in_array($key, $filters);
        })->flip();
    }

    private function getFiltersFromChildClass() : array
    {
        $mirror = new \ReflectionClass(static::class);
        $child_methods = collect($mirror->getMethods(\ReflectionMethod::IS_PUBLIC));

        return $child_methods->map->name->reject(function($method) {
               return in_array($method, ['__construct', 'apply']);
        })->toArray();
    }

}