<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Contracts\Activable as ActiveContract;
use App\Traits\Activable;

class User extends Authenticatable implements ActiveContract
{
    use Notifiable, Activable;

    protected static $type = [
        'admin' => 'admin',
        'visitor' => 'visitor',
        'headhunter' => 'headhunter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function tools()
    {
        return $this->hasMany(Tool::class);
    }

    /*
     * Checks
     */

    public function isAdmin()
    {
        return $this->type === self::$type['admin'];
    }

    public function isHeadHunter()
    {
        return $this->type === self::$type['headhunter'];
    }

    public function isVisitor()
    {
        return $this->type === self::$type['visitor'];
    }

    /*
     * Scopes
     */

    public function scopeAdmins($query)
    {
        return $query->where('type', self::$type['admin']);
    }

    public function scopeHeadHunters($query)
    {
        return $query->where('type', self::$type['headhunter']);
    }

    public function scopeVisitors($query)
    {
        return $query->where('type', self::$type['visitor']);
    }

    /*
     * Attributes
     */

    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->city . ', ' . $this->postcode;
    }

    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
