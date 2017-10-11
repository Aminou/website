<?php
namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class Filters
{
    protected $request, $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->builder = $query;

        $this->filters()->each(function($filter, $value) {
            $this->$filter($value);
        });

        return $this->builder;
    }

    private function filters() : Collection
    {
        return collect($this->request->only($this->getFiltersFromChildClass()))->flip();
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