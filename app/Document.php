<?php

namespace App;

use App\Traits\Filterable;

class Document extends BaseModel
{
    use Filterable;

    public function owner()
    {
        return $this->morphTo('documentable');
    }

    public function getUrlAttribute()
    {
        return $this->path . '/' . $this->filename;
    }

}
