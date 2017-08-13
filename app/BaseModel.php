<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Activable;
use App\Contracts\Activable as ActiveContract;

class BaseModel extends Model implements ActiveContract
{
    use Activable;

    protected $guarded = [];

}