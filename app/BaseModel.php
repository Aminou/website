<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = [];

    protected static $status = [
        'active' => 1,
        'disabled' => 0
    ];

    /**
     * @param $query
     */
    public function scopeActive($query)
    {
        return $query->where('active', self::$status['active']);
    }

    public function scopeDisabled($query)
    {
        return $query->where('active', self::$status['disabled']);
    }
}