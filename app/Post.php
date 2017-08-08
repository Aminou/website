<?php

namespace App;

class Post extends BaseModel
{
    protected $fillable = [
        'title', 'body', 'user_id', 'active'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isPublished()
    {
        return $this->published_at !== null;
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeLive($query)
    {
        return $query->whereNotNull('published_at')->where('active', self::$status['active']);
    }
}
