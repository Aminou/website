<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
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

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
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

    public function isActive()
    {
        return $this->active === self::$status['active'];
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

    //public function scopeTest($query)
    //{
    //    return $this->scopeAdmins($query)->get();
    //}

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
