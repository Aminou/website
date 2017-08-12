<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Activable;

class BaseModel extends Model
{
    use Activable;

    protected $guarded = [];

}