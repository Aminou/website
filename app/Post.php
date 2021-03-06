<?php

namespace App;

use App\Traits\Filterable;

class Post extends BaseModel
{

    use Filterable;

    protected $dates = [
        'published_at'
    ];

    //sqlite will cast the foreign key as a string by default (fails the policy owner test)
    protected $casts = [
      'user_id' => 'integer'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Guest'
        ]);
    }

    public function isPublished()
    {
        return $this->published_at !== null;
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeUnpublished($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeLive($query)
    {
        return $query->whereNotNull('published_at')->where('active', self::$status['active']);
    }


    /* utilities */

    public function publishedDate()
    {
        return ucwords($this->published_at->formatLocalized('%d %B %Y'));
    }

    public function year()
    {
        return $this->published_at->year;
    }


}
