<?php

namespace App;

class Job extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
