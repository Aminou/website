<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    protected static $status = [
        'active' => 1,
        'disable' => 0
    ];

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


    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    /*
     * Checks
     */

    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isActive()
    {
        return $this->active === self::$status['active'];
    }

    public function isHeadHunter()
    {
        return $this->type === self::$type['headhunter'];
    }

    public function isVisitor()
    {
        return $this->type === self::type['visitor'];
    }

    /*
     * Scopes
     */

    public function scopeActive($query)
    {
        return $query->where('active', self::$status['active']);
    }

    public function scopeDisable($query)
    {
        return $query->where('active', self::$status['disable']);
    }

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
