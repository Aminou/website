<?php

namespace App;

class Job extends BaseModel
{

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
