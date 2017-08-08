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

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
