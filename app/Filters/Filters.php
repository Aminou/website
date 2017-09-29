<?php
namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \ReflectionClass;

abstract class Filters
{
    protected $request, $builder;
    private $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setFilters();
    }

    public function apply($query)
    {
        $this->builder = $query;

        $this->getFilters()
             ->filter(function($filter) {
                 return $this->filterExists($filter);
             })->each(function($filter, $value) {
                 $this->$filter($value);
             });

        return $this->builder;
    }

    protected function filter($filter, array $value = [])
    {
        return $this->builder->$filter($value);
    }

    private function getFilters() : Collection
    {
        return collect($this->request->only($this->filters))->flip();
    }

    private function filterExists($filter) : bool
    {
        return method_exists($this, $filter);
    }

    private function setFilters()
    {
        $mirror = new ReflectionClass(static::class);
        $filters = collect($mirror->getMethods(\ReflectionMethod::IS_PUBLIC))->map->name;

        $this->filters = $filters->reject(function($method) {
                            return in_array($method, ['__construct', 'apply']);
                         })->toArray();
    }

}