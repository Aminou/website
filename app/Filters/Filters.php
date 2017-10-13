<?php
namespace App\Filters;

use Illuminate\Support\Collection;

abstract class Filters
{
    protected $params, $builder;

    public function __construct()
    {
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

    private function setFilters()
    {
        $request = request();

        if ($request->segment(2) === 'filters') {
            $segments = collect($request->segments())->slice(2);

            $filters = $segments->nth(2);
            $values = $segments->nth(2, 1);

            return $filters->combine($values);
        }

        return collect();

    }

    private function filters() : Collection
    {
        return $this->params->filter(function ($value, $key) {
            return in_array($key, $this->getFiltersFromChildClass());
        })->flip();
    }

    private function getFiltersFromChildClass()
    {
        $mirror = new \ReflectionClass(static::class);
        $child_methods = collect($mirror->getMethods(\ReflectionMethod::IS_PUBLIC));

        return $child_methods->map->name->reject(function($method) {
               return in_array($method, ['__construct', 'apply']);
        })->toArray();
    }

}