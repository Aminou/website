<?php

namespace App;

class Skill extends BaseModel
{

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'user_id' => 1
        ]);
    }
}
